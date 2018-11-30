<?php
/**
 * Created by PhpStorm.
 * User: hudy@cnfol.net
 * Date: 2018/11/30
 * Time: 17:43
 */

abstract class ApptEncoder {
	abstract function encode();
}

class BloggsApptEncoder extends ApptEncoder
{
	function encode() {
		return "Appointment data encoded in BloggsCal format\n";
	}
}

class MegaApptEncoder extends ApptEncoder
{
	function encode() {
		return "Appoint data encoded in MegaCal format\n";
	}
}

class CommsManager {
	const BLOGGS = 1;
	const MEGA = 2;
	private $mode = 1;

	function __construct($mode) {
		$this->mode = $mode;
	}

	function getHeaderText()
	{
		switch($this->mode)
		{
			case (self::MEGA):
				return "MegaCal header\n";
			default:
				return "BloggsCal header\n";
		}
	}

	function getApptEncoder()
	{
		switch ($this->mode)
		{
			case (self::MEGA):
				return new MegaApptEncoder();
			default:
				return new BloggsApptEncoder();
		}
	}
}

$comms = new CommsManager(CommsManager::MEGA);
$apptEncoder = $comms->getApptEncoder();
print $apptEncoder->encode();