<?php

namespace CampaignBundle;

use Core\Controller;
use Lib\PDO;

class BenchMarkController extends Controller
{
    private $_pdo;

    public function __construct() 
    {
        parent::__construct();
        $this->_pdo = PDO::getInstance();
    }

    public function benchmarkAction()
    {
        $data = file_get_contents("php://input"); 
        $data = $data ? $data : 'test';
        $sql = "INSERT `benchmark` SET data = :data AND created = :created";
        $query = $this->_pdo->prepare($sql);    
        return $query->execute([':data' => $data, ':created' => NOWTIME]);
    }
}