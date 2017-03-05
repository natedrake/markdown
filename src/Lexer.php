<?php
/**
 * Created by PhpStorm.
 * User: John
 * Date: 05/03/2017
 * Time: 11:52
 */

namespace Markdown;


class Lexer
{
    /**
     * @var string $input
     */
    private $input;

    /**
     * Lexer constructor.
     * @param $input
     */
    public function __construct($input)
    {
        $this->input=$input;
    }

    /**
     * @param $length
     */
    public function consumeInput($length)
    {
        $this->input=substr($this->input, $length, (strlen($this->input)-$length));
    }

    public function parse()
    {
        $matches=null;

        if (strlen($this->input)<=0) {
            return new Token('eos', '');
        }
        else if (preg_match('/^\n/', $this->input, $matches)) {
            $this->consumeInput(strlen($matches[0]));
            return new Token('newline', '<br />');
        }
        elseif (preg_match('/^[_]{2}([^_;]+)[_]{2}/', $this->input, $matches)) {
            $this->consumeInput(strlen($matches[0]));
            return new Token('em', $matches);
        }
        elseif (preg_match('/^[#]+([^\n;]+)/', $this->input, $matches)) {
            $this->consumeInput(strlen($matches[0]));
            return new Token('heading', $matches);
        }
        elseif (preg_match('/^\*{2}([^\*;]+)[\*]{2}/', $this->input, $matches)) {
            $this->consumeInput(strlen($matches[0]));
            return new Token('strong', $matches);
        }
        elseif (preg_match('/^[`]{3}([^`;]+)[`]{3}/', $this->input, $matches)) {
            $this->consumeInput(strlen($matches[0]));
            return new Token('code', $matches);
        }
        elseif(preg_match('/^\n[-]{3}\n/', $this->input, $matches)) {
            $this->consumeInput(strlen($matches[0]));
            return new Token('hr', $matches);
        }
        elseif(preg_match('/^\[([^\];]+)]\(([^\);]+)\)/', $this->input, $matches)) {
            $this->consumeInput($matches[0]);
            return new Token('a', $matches);
        }
        else if(preg_match('/^!\[([^\];]+)]\(([^;]+)\)/', $this->input, $matches)) {
            $this->consumeInput(strlen($matches[0]));
            return new Token('img', $matches);
        }
        elseif (preg_match('/[^\*#_\[\n`;]+/)', $this->input, $matches)) {
            $this->consumeInput(strlen($matches[0]));
            return new Token('text', $matches);
        }
        else {
            /**
             * @todo
             *      default action if no regex expressions met
             */
        }
    }
}