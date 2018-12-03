<?php
/**
 * Created by PhpStorm.
 * User: hudy@cnfol.net
 * Date: 2018/12/3
 * Time: 15:28
 */

class Login {
	const LOGIN_USER_UNKONW = 1;
	const LOGIN_WRONG_PASS = 2;
	const LOGIN_ACCESS = 3;
	private $status = [];

	function handleLogin($user, $pass, $ip)
	{
		switch(rand(1, 3))
		{
			case 1:
				$this->setStatus(self::LOGIN_ACCESS, $user, $ip);
				$ret = true;
				break;
			case 2:
				$this->setStatus(self::LOGIN_WRONG_PASS, $user, $ip);
				$ret = false;
				break;
			case 3:
				$this->setStatus(self::LOGIN_USER_UNKONW, $user, $ip);
				$ret = false;
				break;
		}
		if( ! $ret)
		{
			Notifier::mainWarning($user, $ip, $this->getStatus());
		}
		Logger::logIP($user, $ip, $this->getStatus());
		return $ret;
	}

	private function setStatus($status, $user, $ip)
	{
		$this->status = [$status, $user, $ip];
	}

	function getStatus()
	{
		return $this->status;
	}
}






































