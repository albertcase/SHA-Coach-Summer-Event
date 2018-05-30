<?php

namespace CampaignBundle;

use Core\Controller;
use Lib\Helper;

class BenchmarkController extends Controller
{
    private $_pdo;

    public function __construct() 
    {
        parent::__construct();
    }

    public function benchmarkAction()
    {
        $data = file_get_contents("php://input"); 
        $data = $data ? $data : 'test';
        $helper = new Helper();
        $insertData = new \stdClass();
        $insertData->created = date('Y-m-d H:i:s');
        $insertData->data = $data;
        $helper->insertTable('benchmark', $insertData);
        $this->statusPrint(200);
    }
}