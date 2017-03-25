<?php
/**
 * @author natedrake
 * @date 05/03/2017
 */

namespace Markdown;

/**
 * Class Dumper
 * @package Markdown
 */
class Dumper
{
    /**
     * @var Token $previousElement
     */
    private $previousElement=null;
    /**
     * @var array $elements
     */
    private $elements;
    /**
     * @var string $dump
     */
    private $dump='';

    private $blockElements=array(
        'heading',
        'text'
    );

    /**
     * Dumper constructor.
     * @param array $elements
     */
    public function __construct($elements)
    {
        $this->elements=$elements;
    }

    /**
     * @return mixed
     */
    public function parse()
    {
        /**
         * @var Token $element
         */
        foreach($this->elements as $key=>$element) {
            $return=null;
            switch($element->type) {
                case 'newline':
                    if ($this->previousElement !== null) {
                        if ($this->previousElement->type() !== 'newline' && (in_array($this->previousElement->type(), $this->blockElements)) !== true) {
                            $return.='<br />';
                        }
                    }
                    $return.='';
                    break;
                case 'heading':
                    $headingSize = strlen($this->elements[$key]->value[1]);
                    $return = '<h'.$headingSize.'>'.$element->value[2].'</h'.$headingSize.'>';
                    break;
                case 'strong':
                    $return = '<strong>'.$this->elements[$key]->value[1].'</strong>';
                    break;
                case 'em':
                    $return = '<i>'.$this->elements[$key]->value[1].'</i>';
                    break;
                case 'code':
                    $code = '<code>'.$this->elements[$key]->value[1].'</code>';
                    if (($this->elements[$key-1] !== null) && isset($this->elements[$key+1])) {
                        if ($this->elements[$key-1]->type==='newline' && $this->elements[$key+1]->type==='newline') {
                            $return = '<pre>'.$code.'</pre>';
                        }
                    } else {
                        $return = $code;
                    }
                    break;
                case 'hr':
                    $return = '<hr />';
                    break;
                case 'a':
                    $return = '<a target="_blank" href="'.$this->elements[$key]->value[2].'">'.$this->elements[$key]->value[1].'</a>';
                    break;
                case 'img':
                    $return = '<img alt="'.$this->elements[$key]->value[1].'" src="'.$this->elements[$key]->value[2].'" style="width:100%;" />';
                    break;
                case 'eos':
                    $return = 'eos';
                    break;
                case 'text':
                    $return = '<p>'.$this->elements[$key]->value[0].'</p>';
                    break;
                default:
                    break;
            }
            $this->previousElement=$element;
            $this->dump.=$return;
        }
        return $this->dump;
    }
}