<?php
/**
 * Created by PhpStorm.
 * User: hudy@cnfol.net
 * Date: 2018/11/29
 * Time: 18:02
 */

abstract class Lesson {
	private $duration;
	private $costStrategy;

	function __construct($duration, CostStrategy $strategy) {
		$this->duration = $duration;
		$this->costStrategy = $strategy;
	}

	function cost()
	{
		return $this->costStrategy->cost($this);
	}

	function chargeType()
	{
		return $this->costStrategy->chargeType();
	}

	function getDuration()
	{
		return $this->duration;
	}
}

class Lecture extends Lesson {

}

class Seminar extends Lesson {

}

abstract class CostStrategy {
	abstract function cost(Lesson $lesson);
	abstract function chargeType();
}

class TimedCostStrategy extends CostStrategy {
	function cost(Lesson $lesson) {
		return $lesson->getDuration();
	}

	function chargeType()
	{
		return 'hourly rate';
	}
}

class FixedCostStrategy extends CostStrategy {
	function cost(Lesson $lesson)
	{
		return 30;
	}

	function chargeType()
	{
		return "fixed rate";
	}
}

$lessons[] = new Seminar(4, new TimedCostStrategy());
$lessons[] = new Lecture(4, new FixedCostStrategy());

foreach($lessons as $lesson)
{
	print "lesson charge {$lesson->cost()}. ";
	print "charge type: {$lesson->chargeType()}\n";
}
















