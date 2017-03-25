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
        $this->lexer->input=$this->input;
        /**
         * @var Token $t
         */
        $t=$this->lexer->parse();

//        echo "\n==== Token Type ====\n";
//        var_dump($t->type());

        $elements=[];
        while($t->type() !== 'eos') {
            if ($t->type() !== 'newline') {
//                echo "==== Token Dump ====\n";
//                print_r($t->value());
                $elements[]=$t;

            }
            $t=$this->lexer->parse();
//            echo "\n==== Next Token Type ====\n";
//            var_dump($t->type());
        }
        return $elements;
    }
}