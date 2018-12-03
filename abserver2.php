<?php
/**
 * Created by PhpStorm.
 * User: hudy@cnfol.net
 * Date: 2018/12/3
 * Time: 15:36
 */

interface Observable {
	function attach(Observer $observer);
	function detach(Observer $observer);
	function notify();
}

// ... Login 类
class Login implements Observable
{
	private $observers;

	function __construct() {
		$this->observers = [];
	}

	function attach(Observer $observer)
	{
		$this->observers[] = $observer;
	}

	function detach( Observer $observer ) {
		$newobservers = [];
		foreach($this->observers as $obs)
		{
			if(($obs !== $observer))
			{
				$newobservers[] = $obs;
			}
			$this->observers = $newobservers;
		}
	}

	function notify()
	{
		foreach($this->observers as $obs)
		{
			$obs->update($this);
		}
	}
}

interface Observer{
	function update(Observable $observable);
}

//class SecurityMonitor extends Observer {
//	function update(Observable $observable)
//	{
//		$status = $observable->getStatus();
//		if($status[0] == Login::LOGIN_WRONG_PASS)
//		{
//			// 发送邮件给系统管理员
//			print __CLASS__ . ": \t sending mail to sysadmin\n";
//		}
//	}
//}

abstract class LoginObserver implements Observer
{
	private $login;
	function __construct(Login $login)
	{
		$this->login = $login;
		$login->attach($this);
	}

	function update(Observable $observable)
	{
		if($observable == $this->login)
		{
			$this->doUpdate($observable);
		}
	}

	abstract function doUpdate(Login $login);
}

class SecurityMonitor extends LoginObserver
{
	function doUpdate( Login $login ) {
		$status = $login->getStatus();
		if($status[0] == Login::LOGIN_WRONG_PASS)
		{
			// 发送邮件给系统管理员
			print __CLASS__ . ": \tsending mail to sysadmin\n";
		}
	}
}

class GeneralLogger extends LoginObserver
{
	function doUpdate( Login $login ) {
		$status = $login->getStatus();
		// 记录登录数据到日志
		print __CLASS__ . ": \tadd login data to log\n";
	}
}

class PartnershipTool extends LoginObserver
{
	function doUpdate( Login $login ) {
		$status = $login->getStatus();
		// 检查 IP 地址
		// 如果匹配列表, 则设置 cookie
		print __CLASS__ . ":\t set cookie if IP matches a list\n";
	}
}

$login = new Login();
new SecurityMonitor($login);
new GeneralLogger($login);
new PartnershipTool($login);










































