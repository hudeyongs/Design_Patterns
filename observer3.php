<?php
/**
 * Created by PhpStorm.
 * User: hudy@cnfol.net
 * Date: 2018/12/3
 * Time: 16:02
 */

class Login implements SplSubject
{
	private $storage;

	function __construct()
	{
		$this->storage = new SplObjectStorage();
	}

	function attach( SplObserver $observer ) {
		$this->storage->attach($observer);
	}

	function detach( SplObserver $observer ) {
		$this->storage->detach($observer);
	}

	function notify()
	{
		foreach($this->storage as $obs)
		{
			$obs->update($this);
		}
	}
}

abstract class LoginObserver implements SplObserver
{
	private $login;

	function __construct(Login $login) {
		$this->login = $login;
		$login->attach($this);
	}

	function update(SplSubject $subject)
	{
		if($subject == $this->login)
		{
			$this->doUpdate($subject);
		}
	}

	abstract function doUpdate(Login $login);
}

































