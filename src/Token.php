<?php
/**
 * Created by PhpStorm.
 * User: John
 * Date: 05/03/2017
 * Time: 11:50
 */

namespace Markdown;


class Token
{
    /**
     * @var string
     */
    public $type;
    /**
     * @var string
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

        return ['type'=>$this->type, 'value'=>$this->value];
    }
}