<?php
/**
 * Created by PhpStorm.
 * User: hudy@cnfol.net
 * Date: 2018/12/3
 * Time: 14:43
 */

abstract class Expression {
	private static $keycount = 0;
	private $key;
	abstract function interpret (InterpreterContext $context);

	function getKey()
	{
		if( ! isset($this->key))
		{
			self::$keycount++;
			$this->key = self::$keycount;
		}
		return $this->key;
	}
}

class LiteralExpression extends Expression
{
	private $value;

	function __construct($value) {
		$this->value = $value;
	}

	function interpret( InterpreterContext $context ) {
		$context->replace($this, $this->value);
	}
}

class InterpreterContext {
	private $expressionstore = [];

	function replace(Expression $exp, $value)
	{
		$this->expressionstore[$exp->getKey()] = $value;
	}

	function lookup(Expression $exp)
	{
		return $this->expressionstore[$exp->getKey()];
	}
}

$context = new InterpreterContext();
$literal = new LiteralExpression('four');
$literal->interpret($context);
print $context->lookup($literal) . "\n";