<?php
/**
 * @author natedrake
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
     * @return mixed
     */
    protected function getNextToken()
    {
        $scanners=array(
            'scanEOS',
            'scanHR',
            'scanNewline',
            'scanEm',
            'scanHeading',
            'scanStrong',
            'scanCode',
            'scanMultiLineCode',
            'scanLink',
            'scanImg',
            'scanText'
        );

        foreach ($scanners as $scanner) {
            $token=$this->$scanner();

            if ($token !== null && $token) {
                return $token;
            }
        }
    }

    /**
     * @param $regex
     * @param $type
     * @return Token
     */
    protected function scanInput($regex, $type)
    {
        $matches=array();
        if (preg_match($regex, $this->input, $matches)) {
            $this->consumeInput(mb_strlen($matches[0]));
            if ($type==='heading') {

            }
            return new Token($type, $matches);
        }
    }

    /**
     * @return Token
     */
    public function scanEOS()
    {
        if (mb_strlen($this->input)<=0) {
            return new Token('eos', '');
        }
    }

    /**
     * @return Token
     */
    protected function scanNewline()
    {
        return $this->scanInput('/^\n/', 'newline');
    }

    /**
     * @return Token
     */
    protected function scanReturn()
    {
        return $this->scanInput('/^\r/', 'newline');
    }

    /**
     * @return Token
     */
    protected function scanEm()
    {
        return $this->scanInput('/^[_]{2}([^_;]+)[_]{2}/', 'em');
    }

    /**
     * @return Token
     */
    protected function scanHeading()
    {
        return $this->scanInput('/(^[#]+)([^\n;]+)/', 'heading');
    }

    /**
     * @return Token
     */
    protected function scanStrong()
    {
        return $this->scanInput('/^\*{2}([^\*;]+)[\*]{2}/', 'strong');
    }

    /**
     * @return Token
     */
    protected function scanCode()
    {
        return $this->scanInput('/^[`]{3}([^`;]+)[`]{3}/', 'code');
    }

    protected function scanMultiLineCode()
    {
        return $this->scanInput('/^[`]{4}[\n]([^`;]+)[\n][`]{4}/', 'pre');
    }

    /**
     * @return Token
     */
    protected function scanHR()
    {
        return $this->scanInput('/^\n[-]{3}\n/', 'hr');
    }

    /**
     * @return Token
     */
    protected function scanLink()
    {
        return $this->scaninput('/^\[([^\];]+)]\(([^\);]+)\)/', 'a');
    }

    protected function scanImg()
    {
        return $this->scanInput('/^!\[([^\];]+)]\(([^;]+)\)/', 'img');
    }

    /**
     * @return Token
     */
    protected function scanText()
    {
        return $this->scanInput('/^[^\*#_\[\n`;]+/', 'text');
    }

    /**
     * @return Token
     */
    public function parse()
    {
        $matches=null;
        return $this->getNextToken();
    }
}