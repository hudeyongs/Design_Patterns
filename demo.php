<?php

include 'strategy.php';

/**
 * Created by PhpStorm.
 * User: hudy@cnfol.net
 * Date: 2018/11/30
 * Time: 16:24
 */

class RegistrationMgr {
	function register( Lesson $lesson)
	{
		// 处理该课程

		// 通知某人
		$notifier = Notifier::getNotifier();
		$notifier->inform("new lesson: cost({$lesson->cost()}");
	}
}

abstract class Notifier {
	static function getNotifier()
	{
		// 根据配置或其他逻辑获得具体的类

		if(rand(1, 2) == 1)
		{
			return new MailNotifier();
		} else {
			return new TextNotifier();
		}
	}

	abstract function inform($message);
}

class MailNotifier extends Notifier
{
	function inform( $message ) {
		print "MAIL notification: {$message}\n";
	}
}

class TextNotifier extends Notifier
{
	function inform( $message ) {
		print "TEXT notification: {$message}\n";
	}
}

$lesson1 = new Seminar(4, new TimedCostStrategy());
$lesson2 = new Lecture(4, new FixedCostStrategy());
$mgr = new RegistrationMgr();
$mgr->register($lesson1);
$mgr->register($lesson2);