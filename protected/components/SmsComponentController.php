<?php

class SmsComponentController extends SmsController
{
    	function __construct()
	{
		parent::__construct();
		$this->initSMS();
	}
	public function initSMS()
	{
		$this->setUserLogin('immobilier');
		$this->setUserPassword('boutiksms8');
		$this->setCountryCode('84');
	}

	public function getPhoneNumber($number)
	{
		return $this->setPhoneNumber($number);
	}

	public function getMessages($messages)
	{
		return $this->setMessages($messages);
	}

	public function getMode($mode)
	{
		return $this->mode = $mode;
	}

	public function getOrigine($origine)
	{
		return $this->origine = $origine;
	}

	public function getDate($date)
	{
		return $this->date = $date;
	}

	public function getTime($time)
	{
		return $this->time = $time;
	}

	public function startSendingSMS()
	{
		return $this->sendingSMS();
	}

}
