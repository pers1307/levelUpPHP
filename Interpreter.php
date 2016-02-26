<?php

/**
 * Class Expression
 * 220
 */
abstract class Expression
{
    private static $keycount = 0;
    private $key;

    abstract function interpret(InterpretterContext $context);

    function getKey()
    {
        if (!isset($this->key)) {
            self::$keycount++;
            $this->key = self::$keycount;
        }

        return $this->key;
    }
}

class LiteralExpression extends Expression
{
     private $value;

    function __construct($value)
    {
        $this->value = $value;
    }

    function interpret(InterpretterContext $context)
    {
        $context->replace($this, $this->value);
    }
}

class InterpreterContext
{
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
$literal = new LiteralExpression('Четыре');
$literal->interpret($context);

echo $context->lookup($literal);