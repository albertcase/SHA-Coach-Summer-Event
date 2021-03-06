<?php
define('SITE_URL', dirname(dirname(__FILE__)));
require_once SITE_URL . "/vendor/autoload.php";
require_once SITE_URL . "/config/config.php";

use CampaignBundle\HelpLib;


$help = new HelpLib();

$date = date('Y-m-d', strtotime('next day'));
// $date = '2018-06-09';
$notificationList = $help->getNotificationList($date);

foreach($notificationList as $notification) {
    $notification['date'] = $help->nomorlizeDate($notification['date']).' ('.$notification['title'].')';
    $re = sendMessage($notification);
    if($re->code == 200 && $re->data->errcode == 0) {
        $help->updateSendStatus($notification['id']);
        echo "{$re->code} - {$notification['openid']} - {$notification['date']} {$notification['title']}\n";
    }
}


/**
 * 发送模版消息
 * param ["openid":用户标识]
 */
function sendMessage($data) {
    $data = array(
        'touser' => $data['openid'],
        'template_id' => 'WndD3kOmw-_OvtTPg0yfs0qziEWoHirCnsyXF8IiPns',
        'url' => '',
        'topcolor' => '#000000',
        'data' => array(
            'first' => array(
                'value' => "尊敬的顾客，Coach夏日派对即将开始，你已预约夏日冰品一份。",
                'color' => '#000000'
            ),
            'keyword1' => array(
                'value' => '尊敬的顾客',
                'color' => '#000000'
            ),
            'keyword2' => array(
                'value' => $data['date'],
                'color' => '#000000'
            ),
            'remark' => array(
                'value' => "期待与你清凉一夏！",
                'color' => '#000000'
            )

        )
    );
    $api_url = "http://coach.samesamechina.com/v2/wx/template/send?access_token=zcBpBLWyAFy6xs3e7HeMPL9zWrd7Xy";
    $rs = postData($api_url, $data);
    return json_decode($rs);
}

/**
 * post data
 */
 function postData($api_url, $data) {
    $ch = curl_init ();
    curl_setopt ( $ch, CURLOPT_URL, $api_url );
    curl_setopt ( $ch, CURLOPT_POST, 1 );
    curl_setopt ( $ch, CURLOPT_HEADER, 0 );
    curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
    curl_setopt ( $ch, CURLOPT_POSTFIELDS, json_encode($data) );
    $return = curl_exec ( $ch );
    return $return;
    curl_close ($ch);
}

/**
 * 记录消息推送日志
 */
function pushLog($db, $data) {
    $loginfo = new \stdClass();
    $loginfo->apply_id = $data['id'];
    $loginfo->openid = $data['openid'];
    $loginfo->name = $data['name'];
    $loginfo->status = 1;
    return $db->insertPushLog($loginfo);
}
