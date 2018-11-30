<?php
/**
 * Created by PhpStorm.
 * User: hudy@cnfol.net
 * Date: 2018/11/29
 * Time: 17:44
 */

abstract class Lesson {
	protected $duration;
	const FIXED = 1;
	const TIMED = 2;
	private $costtype;

	function __construct($duration, $costtype = 1)
	{
		$this->duration = $duration;
		$this->costtype = $costtype;
	}

	function cost()
	{
		switch($this->costtype)
		{
			case self::TIMED:
				return (5 * $this->duration);
				break;
			case self::FIXED:
				return 30;
				break;
			default:
				$this->costtype = self::FIXED;
				return 30;
		}
	}

	/**
	 * @return string
	 */
	function chargeType()
	{
		switch($this->costtype)
		{
			case self::TIMED:
				return 'hourly rate';
				break;
			case self::FIXED;
				return 'fixed rate';
			break;
			default:
				$this->costtype = self::FIXED;
				return 'fixed rate';
		}
	}
}

class Lecture extends Lesson {
	// Lecture 特定的实现
}

class Seminar extends Lesson {
	// Seminar 特定的实现
}

$lecture = new Lecture(5, Lesson::FIXED);

echo "{$lecture->cost()} ({$lecture->chargeType()})\n";

$seminal = new Seminar(3, Lesson::TIMED);

echo "{$seminal->cost()} ({$seminal->chargeType()})\n";





























