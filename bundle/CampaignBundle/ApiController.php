<?php

namespace CampaignBundle;

use Core\Controller;
use Lib\PDO;
use Lib\userAPI;
use Lib\Helper;
use CampaignBundle\HelpLib;

class ApiController extends Controller
{
    private $_pdo;

    public function __construct() 
    {
    	global $user;
        parent::__construct();
        if(!$user->uid) {
            $this->statusPrint('100', 'access deny!');
        } 
    }

    public function quotaAction()
    {
        $help = new HelpLib();  
        $reservationRawList = $help->getReservationList();
        $reservationList = [];
        if(!empty($reservationRawList)) {
            foreach ($reservationRawList as $value) {
                $start = $value['date'] . ' ' . $value['start'];
                $end = $value['date'] . ' ' . $value['end'];
                if(NOWTIME > $end || $value['quota'] <= $value['used']) {
                    $has_quota =  false;
                } else {
                    $has_quota =  true;
                }
                $reservationList[$value['name']][$help->nomorlizeDate($value['date'])][] = ['time' => $value['title'], 'id' => $value['id'], 'has_quota' => $has_quota];

            }
        }
        $this->dataPrint($reservationList);
    }

    public function checkinAction()
    {
        global $user;
        $jsonData = file_get_contents("php://input"); 
        $apiData = json_decode($jsonData);
        if(is_null($apiData)) {
            $this->statusPrint('301', 'API参数不是json格式！');
        }
        if(empty($apiData->code)) {
            $this->statusPrint('302', 'code is empty');
        }
        if($apiData->code != CHECKIN_CODE) {
            $this->statusPrint('303', 'code is wrong');
        }
        $help = new HelpLib();  
        $help->checkin($user->uid);
        $this->statusPrint(200);
    }

    // 预约提交
    // 1.验证字段
    // 2.验证是否预约
    // 3.验证库存
    // 4.预约
    public function submitAction()
    {
        global $user;
        $jsonData = file_get_contents("php://input"); 
        $apiData = json_decode($jsonData);
        if(is_null($apiData)) {
            $this->statusPrint('101', 'API参数不是json格式！');
        }

        if(!$apiData->id) {
            $this->statusPrint('102', '预约场次不能为空！');
        }

        $help = new HelpLib();

        // 是否已经预约过
        if($help->findReservationByUid($user->uid)) {
            $this->statusPrint('103', '您已经预约过！');
        }

        // 场次名额是否还有
        if(!$help->hasQuota($apiData->id)) {
            $this->statusPrint('104', '预约名额已经全部预约完！');
        }

    	if($re = $help->submit($apiData)) {
            $openid = $user->openid;
            $this->dataPrint(['status' => 200, 'data' => $re], function() use ($help, $re, $openid) {
                $re->openid = $openid;
                $help->sendMessage($re);
            });
        }
        $this->statusPrint('105', '预约失败！');
        
    }
}