<?php
/**
 * @author John
 * @date 05/03/2017
 */

namespace Markdown;

/**
 * Class Lexer
 * @package Markdown
 */
class Lexer
{
    /**
     * @var string $input
     */
    public $input;

    /**
     * Lexer constructor.
     * @param $input
     */
    public function __construct($input)
    {
        $this->input=preg_replace(['/\r\n|\r/', '/\t/'], ["\n", ' '], $input);
    }

    /**
     * @param $length
     */
    public function consumeInput($length)
    {
        $this->input=mb_substr($this->input, $length);
    }

    /**
     * @return Token
     * @throws \Exception
     */
    public function parse()
    {
        $matches=null;

        if (mb_strlen($this->input)<=0) {
            return new Token('eos', '');
        }
        elseif (preg_match('/^\n/', $this->input, $matches) || preg_match('/^\r/', $this->input, $matches)) {
            $this->consumeInput(mb_strlen($matches[0]));
            return new Token('newline', $matches);
        }
        elseif (preg_match('/^[_]{2}([^_;]+)[_]{2}/', $this->input, $matches)) {
            $this->consumeInput(mb_strlen($matches[0]));
            return new Token('em', $matches);
        }
        elseif (preg_match('/(^[#]+)([^\n;]+)/', $this->input, $matches)) {
//            echo "\n=== Header Regex Matches ====\n";
//            print_r($matches);
            $this->consumeInput(mb_strlen($matches[0]));
            return new Token('heading', $matches);
        }
        elseif (preg_match('/^\*{2}([^\*;]+)[\*]{2}/', $this->input, $matches)) {
            $this->consumeInput(mb_strlen($matches[0]));
            return new Token('strong', $matches);
        }
        elseif (preg_match('/^[`]{3}([^`;]+)[`]{3}/', $this->input, $matches)) {
            $this->consumeInput(mb_strlen($matches[0]));
            return new Token('code', $matches);
        }
        elseif(preg_match('/^\n[-]{3}\n/', $this->input, $matches)) {
            $this->consumeInput(mb_strlen($matches[0]));
            return new Token('hr', $matches);
        }
        elseif(preg_match('/^\[([^\];]+)]\(([^\);]+)\)/', $this->input, $matches)) {
            $this->consumeInput(mb_strlen($matches[0]));
            return new Token('a', $matches);
        }
        else if(preg_match('/^!\[([^\];]+)]\(([^;]+)\)/', $this->input, $matches)) {
            $this->consumeInput(mb_strlen($matches[0]));
            return new Token('img', $matches);
        }
        elseif (preg_match('/^[^\*#_\[\n`;]+/', $this->input, $matches)) {
            $this->consumeInput(mb_strlen($matches[0]));
            return new Token('text', $matches);
        }
        else {
            /**
             * @todo
             *      default action if no regex expressions met
             */
            echo "\n==== Unknown Regex Character ====\n";
            echo ord($this->input);
            throw new \Exception(sprintf('Failed to find token on %s', $this->input));
        }
    }
}