<?php
/**
 * Created by PhpStorm.
 * User: hudy@cnfol.net
 * Date: 2018/11/30
 * Time: 16:55
 */

abstract class Employee {
	protected $name;
	function __construct($name) {
		$this->name = $name;
	}
	abstract function fire();
}

class Minion extends Employee
{
	function fire()
	{
		print "{$this->name}: I'll clear my desk\n";
	}
}

class NastyBoss {
	private $employees = [];

	function addEmployee($employeeName)
	{
		$this->employees[] = new Minion($employeeName);
	}

	function projectFails()
	{
		if(count($this->employees) > 0)
		{
			$emp = array_pop($this->employees);
			$emp->fire();
		}
	}
}

$boss = new NastyBoss();
$boss->addEmployee("harry");
$boss->addEmployee("bob");
$boss->addEmployee('marry');
$boss->projectFails();




























