<?php
/**
 * Created by PhpStorm.
 * User: hudy@cnfol.net
 * Date: 2018/12/3
 * Time: 13:55
 */

abstract class Tile {
	abstract function getwealthFactor();
}

class Plains extends Tile {
	private $wealthfactor = 2;
	function getwealthFactor() {
		return $this->wealthfactor;
	}
}

abstract class TileDecorator extends Tile
{
	protected $tile;
	function __construct(Tile $tile) {
		$this->tile = $tile;
	}
}

class DiamondDecorator extends TileDecorator {
	function getwealthFactor() {
		return $this->tile->getWealthFactor() + 2;
	}
}

class PollutionDecorator extends TileDecorator
{
	function getwealthFactor() {
		return $this->tile->getWealthFactor() - 4;
	}
}

$tile = new Plains();
print $tile->getWealthFactor(); // 2

$tile = new DiamondDecorator(new Plains());
print $tile->getwealthFactor(); // 4


































