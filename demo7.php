<?php
/**
 * Created by PhpStorm.
 * User: hudy@cnfol.net
 * Date: 2018/11/30
 * Time: 18:03
 */

include 'demo6.php';

abstract class CommsManager {
	abstract function getHeaderText();
	abstract function getApptEncoder();
	abstract function getTtdEncoder();
	abstract function getContactEncoder();
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

	function getTtdEncoder() {
		// todo: 148 (162 / 465)
	}
}