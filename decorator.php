<?php
/**
 * Created by PhpStorm.
 * User: hudy@cnfol.net
 * Date: 2018/12/3
 * Time: 13:43
 */

abstract class Tile {
	abstract function getWealthFactor();
}

class Plains extends Tile {
	private $wealthfactor = 2;

	function getWealthFactor() {
		return $this->wealthfactor;
	}
}

class DiamondPlains extends Plains {
	function getWealthFactor() {
		return parent::getWealthFactor() + 2;
	}
}

class PollutedPlains extends Plains {
	function getWealthFactor() {
		return parent::getWealthFactor() + 4;
	}
}

$tile = new PollutedPlains();
print $tile->getWealthFactor();