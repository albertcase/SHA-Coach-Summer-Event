<?php

namespace Core;

class Controller
{

	public $request;

	public function __construct() 
	{
		$this->request = new Request();
	}

	public function Request() 
	{
		return new Request();
	}

	public function Response($response = '') 
	{
		return new Response($response);
	}

	public function statusPrint($status, $msg = '') 
	{
		$this->Response()->statusPrint($status, $msg);
	}

	public function dataPrint($data, $terminate_call = null) 
	{
		$this->Response()->dataPrint($data, $terminate_call);
	}

	public function redirect($uri) 
	{
		$this->Response()->redirect($uri);
	}

	public function render($tpl_name, $params = array()) 
	{
		$template = new Theme();
		$data = $template->theme($tpl_name, $params);
		$response = new Response($data);
		return $response;
		// $response->send();
	}

	public function getAccessToken() 
	{
		$RedisAPI = new \Lib\RedisAPI();
		return $RedisAPI->getAccessToken();
	}

	public function watchdog($type, $data) 
	{
		$DatabaseAPI = new \Lib\DatabaseAPI();
		$DatabaseAPI->watchdog($type, $data);
	}
}