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

	function addEmployee(Employee $employee)
	{
		$this->employees[] = $employee;
	}

	function projectFails()
	{
		if(count($this->employees))
		{
			$emp = array_pop($this->employees);
			$emp->fire();
		}
	}
}

// 新 Employee 类
class CluedUp extends Employee
{
	function fire()
	{
		print "{$this->name} : I'll call my lawyer\n";
	}
}

$boss = new NastyBoss();
$boss->addEmployee(new Minion("harry"));
$boss->addEmployee(new CluedUp("bob"));
$boss->addEmployee(new Minion("mary"));
$boss->projectFails();
$boss->projectFails();
$boss->projectFails();




























