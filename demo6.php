<?php
/**
 * Created by PhpStorm.
 * User: hudy@cnfol.net
 * Date: 2018/11/30
 * Time: 17:54
 */

abstract class ApptEncoder {
	abstract function encode();
}

class BloggsApptEncoder extends ApptEncoder {
	function encode() {
		return "Appointment data encode in BloggsCal format\n";
	}
}

abstract class CommsManager{
	abstract function getHeaderText();
	abstract function getApptEncoder();
	abstract function getFooterText();
}

class BloggsCommsManager extends CommsManager
{
	function getHeaderText() {
		return "BloggsCal header\n";
	}

	function getApptEncoder() {
		return new BloggsApptEncoder();
	}

	function getFooterText() {
		return "BloggsCal footer\n";
	}

}



























