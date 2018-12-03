<?php
/**
 * Created by PhpStorm.
 * User: hudy@cnfol.net
 * Date: 2018/12/3
 * Time: 11:30
 */

//abstract class Unit {
//	abstract function bombardStrength();
//}

abstract class Unit {
	abstract function bombardStrength();

	function getComposite()
	{
		return null;
	}
}

abstract class CompositeUnit extends Unit {
	private $units = [];

	function getComposite() {
		return $this;
	}

	protected function units()
	{
		return $this->units;
	}

	function removeUnit(Unit $unit)
	{
		$this->units = array_udiff($this->units, [$unit], function($a, $b){
			return ($a === $b) ? 0 : 1;
		});
	}

	function addUnit(Unit $unit)
	{
		if(in_array($unit, $this->units, true))
		{
			return ;
		}
		$this->units[] = $unit;
	}
}

class UnitScript {
	static function joinExisting(Unit $newUnit, Unit $occupyingUnit)
	{
		$comp = null;
		if( ! is_null($comp = $occupyingUnit->getComposite()))
		{
			$comp->addUnit($newUnit);
		} else {
			$comp = new Army();
			$comp->addUnit($occupyingUnit);
			$comp->addUnit($newUnit);
		}
		return $comp;
	}
}

class Army extends Unit {
	private $units = [];

	function addUnit( Unit $unit ) {
		if(in_array($unit, $this->units, true))
		{
			return;
		}
		$this->units[] = $this->unit;
	}

	function removeUnit( Unit $unit ) {
		$this->units = array_udiff($this->units, [$unit], function($a, $b) {
			return ($a === $b) ? 0 : 1;
		});
	}

	function bombardStrength() {
		$ret = 0;
		foreach($this->units as $unit)
		{
			$ret += $unit->bombardStrength();
		}
		return $ret;
	}
}

class UnitException extends Exception {}
class Archer extends Unit {
	function addUnit( Unit $unit ) {
		throw new UnitException(get_class($this) . " is a leaf");
	}

	function removeUnit( Unit $unit ) {
		throw new UnitException(get_class($this) . " is a leaf");
	}

	function bombardStrength() {
		return 4;
	}
}

// 创建一个 Army 对象
$main_army = new Army();

// 添加一些 Unit 对象
$main_army->addUnit(new Archer());
$main_army->addUnit(new LaserCannonUnit());

// 创建一个新的 Army 对象
$sub_army = new Army();

// 添加一些 Unit 对象
$sub_army->addUnit(new Archer());
$sub_army->addUnit(new Archer());
$sub_army->addUnit(new Archer());

// 把第二个 Army 对象添加到第一个 Army 对象中去
$main_army->addUnit($sub_army);

// 所有的攻击强度计算都在幕后进行
print "attacking with strength: {$main_army->bombardStrength()}\n";


