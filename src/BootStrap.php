<?php
/**
 * @author natedrake
 * @ate 05/03/2017
 */

namespace Markdown;

/**
 * Class BootStrap
 * @package Markdown
 */
class BootStrap
{
    /**
     * @var string $input
     */
    private $input;
    /**
     * @var string $output
     */
    private $output;
    /**
     * @var Parser $parser
     */
    public $parser;
    /**
     * @var Dumper $dumper
     */
    public $dumper;

    /**
     * BootStrap constructor.
     * @param $input
     */
    public function __construct($input)
    {
        $this->input=$input;
        $this->parser=new Parser($this->input);
        $this->dumper=new Dumper($this->parser->parse());
    }
}