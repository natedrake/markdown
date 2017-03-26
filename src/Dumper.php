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
                    $headingSize = strlen($element->value[1]);
                    $return = '<h'.$headingSize.'>'.$element->value[2].'</h'.$headingSize.'>';
                    break;
                case 'strong':
                    $return = '<strong>'.$element->value[1].'</strong>';
                    break;
                case 'em':
                    $return = '<i>'.$element->value[1].'</i>';
                    break;
                case 'code':
                    $return='<code>'.$element->value[1].'</code>';
                    break;
                case 'pre':
                    $return='<pre>'.$element->value[1].'</pre>';
                    break;
                case 'hr':
                    $return = '<hr />';
                    break;
                case 'a':
                    $return = '<a target="_blank" href="'.$element->value[2].'">'.$element->value[1].'</a>';
                    break;
                case 'img':
                    $return = '<img alt="'.$element->value[1].'" src="'.$element->value[2].'" style="width:100%;" />';
                    break;
                case 'eos':
                    $return = 'eos';
                    break;
                case 'text':
                    $return = '<p>'.$element->value[0].'</p>';
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