<?php
/**
 * Created by PhpStorm.
 * User: John
 * Date: 05/03/2017
 * Time: 11:33
 */

namespace Markdown;


class Parser
{
    /**
     * @var string $input
     */
    private $input;
    /**
     * @var array $blockElements
     */
    private $blockElements=['heading'];

    private $lexer;

    /**
     * Parser constructor.
     * @param $input
     */
    public function __construct($input)
    {
        $this->input=$input;
    }

    /**
     * @return array
     */
    public function parse()
    {
        $this->lexer->input=$this->input;
        $t=$this->lexer->parse();
        $elements=[];
        while($t->type() !== 'eos') {
            $elements[]=$t;
            $t=$this->lexer->parse();
        }
        return $elements;
    }
}