<?php
/**
 * Created by PhpStorm.
 * User: hudy@cnfol.net
 * Date: 2018/12/3
 * Time: 15:07
 */

abstract class Question {
	protected $prompt;
	protected $marker;

	function __construct($prompt, Marker $marker)
	{
		$this->marker = $marker;
		$this->prompt = $prompt;
	}

	function mark($response)
	{
		return $this->marker->mark($response);
	}
}

class TextQuestion extends Question
{
	// 处理文本问题特有的操作
}

class AVQuestion extends Question
{
	// 处理语音问题特有的操作
}

abstract class Marker {
	protected $test;

	function __construct($test) {
		$this->test = $test;
	}

	abstract function mark($response);
}

class MarkLoginMarker extends Marker
{
	private $engine;

	function __construct( $test ) {
		parent::__construct( $test );
		// $this->engine = new MarkParse($test);
	}

	function mark($response)
	{
		// return $this->engine->evaluate($response);
		// 模拟的返回值
		return true;
	}
}

class MatchMarker extends Marker
{
	function mark($response)
	{
		return ($this->test == $response);
	}
}

class RegexMarker extends Marker
{
	function mark($response)
	{
		return (preg_match($this->test, $response));
	}
}

$markers = [new RegexMarker("/f.ve/"),
	new MatchMarker("five"),
	new MarkLoginMarker("$input equals 'five'")
];

foreach($markers as $marker)
{
	print get_class($marker) . "\n";
	$question = new TextQuestion("how many beans make five", $marker);
	foreach(array("five", "four") as $response)
	{
		print "\tresponse: $response";
		if($question->mark($response))
		{
			print "well done\n";
		} else {
			print "never mind\n";
		}
	}
}



























