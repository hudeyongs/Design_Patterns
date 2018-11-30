<?php
/**
 * Created by PhpStorm.
 * User: hudy@cnfol.net
 * Date: 2018/11/30
 * Time: 17:22
 */

class Preferences {
	private static $instance;
	private $props = array();
	private function __construct() {
	}

	public function setProperty($key, $val)
	{
		$this->props[$key] = $val;
	}

	public function getProperty($key)
	{
		return $this->props[$key];
	}

	public static function getInstance()
	{
		if(empty(self::$instance))
		{
			self::$instance = new Preferences();
		}
		return self::$instance;
	}
}



