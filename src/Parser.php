<?php
/**
 * @author natedrake
 * @date 05/03/2017
 */

namespace Markdown;

/**
 * Class Parser
 * @package Markdown
 */
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
    /**
     * @var Lexer $lexer
     */
    private $lexer;

    /**
     * Parser constructor.
     * @param $input
     */
    public function __construct($input)
    {
        $this->input=$input;
        $this->lexer=new Lexer($this->input);
    }

    /**
     * @return array
     */
    public function parse()
    {
        /**
         * @var Token $t
         */
        $t=$this->lexer->parse();

        $elements=[];

        while($t->type() !== 'eos') {

            $elements[]=$t;
            $t=$this->lexer->parse();
        }
        return $elements;
    }
}

