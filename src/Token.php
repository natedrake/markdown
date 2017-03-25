<?php
/**
 * @author natedrake
 * @date 05/03/2017
 */

namespace Markdown;

/**
 * Class Token
 * @package Markdown
 */
class Token
{
    /**
     * @var string
     */
    public $type;
    /**
     * @var mixed
     */
    public $value;

    /**
     * Token constructor.
     * @param $type
     * @param $value
     */
    public function __construct($type, $value)
    {
        $this->type=$type;
        $this->value=$value;
    }

    /**
     * @return string
     */
    public function type()
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function value()
    {
        return $this->value;
    }
}