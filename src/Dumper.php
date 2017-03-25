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
    private $previousElement;
    /**
     * @var array $elements
     */
    private $elements;
    /**
     * @var string $dump
     */
    private $dump='';


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
        $return=null;

        echo "\n==== Printing Elements ====\n";
        print_r($this->elements);

        foreach($this->elements as $key=>$element) {



            switch($element->type) {
                case 'heading':
                    echo "\n==== Header ====\n";
                    print_r($element);
                    $headingSize = strlen($this->elements[$key]->value[1]);
                    $return = '<h'.$headingSize.'></h'.$headingSize.'>';
                    echo "\n|===={$return}===|\n";
                    break;
                case 'strong':
                    $return = '<strong>'.$this->elements[$key]->value[1].'</strong>';
                    break;
                case 'em':
                    $return = '<i>'.$this->elements[$key]->value[1].'</i>';
                    break;
                case 'code':
                    $code = '<code>'.$this->elements[$key]->value[1].'</code>';
                    if (($this->elements[$key-1] !== null) && ($this->elements[$key+1] !== null)) {
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
                    #var_dump($this->elements[$key]);
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