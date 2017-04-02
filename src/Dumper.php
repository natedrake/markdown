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
                case 'quote':
                    $return='<blockquote>'.$element->value[1].'</blockquote>';
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
                case 'ul':
                    /**
                     * @note explode items from matches array
                     */
                    $items=explode("\n", ltrim(rtrim($element->value[2])));

                    $return.='<ul style="list-style: disc;padding-left:0px;">';
                    $return.='<span style="font-size:1.1em;">'.$element->value[1].'</span>';
                    /**
                     * @note iterate through each item, removing prefix ` - `
                     */
                    foreach($items as $item) {
                        $i=preg_replace('/^\-[\s]/', '',ltrim($item));
                        $return.='<li style="margin-left: 30px;">'.$i.'</li>';
                    }
                    $return.='</ul>';
                    break;
                case 'ol':
                    /**
                     * @note explode items from matches array
                     */
                    $items=explode("\n", ltrim(rtrim($element->value[2])));

                    $return.='<ol style="padding-left: 0px;">';
                    $return.='<span style="font-size:1.1em;">'.$element->value[1].'</span>';
                    /**
                     * @note iterate through each item removing prefix ` . `
                     */
                    foreach ($items as $item) {
                        $i=preg_replace('/^[\d][\.]/', '',ltrim($item));
                        $return.='<li style="margin-left: 30px;">'.$i.'</li>';
                    }
                    $return.='</ol>';
                    break;
                case 'table':
                    /**
                     * @note parse table headings
                     */
                    $headings=ltrim($element->value[1], '\|');
                    $headings=rtrim($headings, '\|');
                    $headings=explode("|", ltrim(rtrim(($headings))));
                    $rows=explode("\n", ltrim(rtrim($element->value[2])));
                    $return.='<table border="border"><thead>';
                    /**
                     * @note iterate through table headings
                     */
                    foreach ($headings as $heading) {
                        $return.="<th>{$heading}</th>";
                    }
                    $return.='</thead><tbody>';
                    /**
                     * @note iterate through table rows, and split into table data
                     */
                    foreach ($rows as $row) {
                        $cols=ltrim(rtrim($row, '\|'), '\|');
                        $cols=explode('|', $cols);
                        $return.='<tr>';
                        /**
                         * @note iterate through each row data and parse table data
                         */
                        foreach ($cols as $col) {
                            $return.="<td>{$col}</td>";
                        }
                        $return.='</tr>';
                    }
                    $return.='</tbody></table>';
                    break;
                case 'strike':
                    $return.='<del>'.$element->value[1].'</del>';
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