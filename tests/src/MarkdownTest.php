<?php
/**
 * @author natedrake
 * @date 25/03/2017
 */
namespace Markdown\Test;

use Markdown\BootStrap;
use PHPUnit_Framework_TestCase;

class MarkdownTest extends PHPUnit_Framework_TestCase
{
    /**
     * TestMarkdown constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @method setUp
     * @return void
     */
    protected function setUp()
    {
        parent::setUp();
    }

    /**
     * @method tearDown
     * @return void
     */
    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @method testHeader
     * @return void
     */
    public function testHeader()
    {
        $markup="<h2>Heading Two</h2>";
        $markdown="##Heading Two";
        $bootstrap= new BootStrap($markdown);
        $this->assertEquals($markup,$bootstrap->dumper->parse());
    }

    /**
     * @method testBold
     * @return void
     */
    public function testBold()
    {
        $markup="<strong>Strong</strong>";
        $markdown="**Strong**";
        $bootstrap=new BootStrap($markdown);
        $this->assertEquals($markup, $bootstrap->dumper->parse());
    }

    /**
     * @method testEmphasize
     * @return void
     */
    public function testEmphasize()
    {
        $markup="<i>Emphasize</i>";
        $markdown="__Emphasize__";
        $bootstrap=new BootStrap($markdown);
        $this->assertEquals($markup, $bootstrap->dumper->parse());
    }

    /**
     * @method testImg
     * @return void
     */
    public function testImg()
    {
        $markup='<img alt="test" src="http://ecneireland.com/test.jpg" style="width:100%;" />';
        $markdown="![test](http://ecneireland.com/test.jpg)";
        $bootstrap=new BootStrap($markdown);
        $this->assertEquals($markup, $bootstrap->dumper->parse());
    }

    /**
     * @method testLink
     * @return void
     */
    public function testLink()
    {
        $markup='<a target="_blank" href="https://google.ie">Google</a>';
        $markdown="[Google](https://google.ie)";
        $bootstrap=new BootStrap($markdown);
        $this->assertEquals($markup, $bootstrap->dumper->parse());
    }

    /**
     * @return void
     */
    public function testHR()
    {
        $markdown='
---
';
        $markup='<hr />';
        $bootstrap=new BootStrap($markdown);
        $this->assertEquals($markup, $bootstrap->dumper->parse());
    }

    /**
     * @return void
     */
    public function testCode()
    {
        $markdown='```code```';
        $markup='<code>code</code>';
        $bootstrap=new BootStrap($markdown);
        $this->assertEquals($markup, $bootstrap->dumper->parse());
    }

    /**
     * @return void
     */
    public function testMultiLineCode()
    {
        $markdown='````
code
````';
        $markup='<pre>code</pre>';
        $bootstrap=new BootStrap($markdown);
        $this->assertEquals($markup, $bootstrap->dumper->parse());
    }

    /**
     * @return void
     */
    public function testUnorderedList()
    {
        $markdown="Contains:
 - MVC Framework
 - ORM Framework
 - Hash Class
 - Input Class
";
        $markup='<ul style="list-style: disc;padding-left:0px;"><span style="font-size:1.1em;">Contains:</span><li style="margin-left: 30px;">MVC Framework</li><li style="margin-left: 30px;">ORM Framework</li><li style="margin-left: 30px;">Hash Class</li><li style="margin-left: 30px;">Input Class</li></ul>';
        $bootstrap=new BootStrap($markdown);
        $this->assertEquals($markup, $bootstrap->dumper->parse());
    }

    /**
     * @return void
     */
    public function testOrderedList()
    {
        $markdown="Contains:
 1. MVC Framework
 2. ORM Framework
 4. Hash Class
 3. Input Class
";
        $markup='<ol style="padding-left: 0px;"><span style="font-size:1.1em;">Contains:</span><li style="margin-left: 30px;"> MVC Framework</li><li style="margin-left: 30px;"> ORM Framework</li><li style="margin-left: 30px;"> Hash Class</li><li style="margin-left: 30px;"> Input Class</li></ol>';
        $bootstrap=new BootStrap($markdown);
        $this->assertEquals($markup, $bootstrap->dumper->parse());
    }

    /**
     * @return void
     */
    public function testQuoteBlock()
    {
        $markdown="> This is a quote block";
        $markup='<blockquote> This is a quote block</blockquote>';
        $bootstrap=new BootStrap($markdown);
        $this->assertEquals($markup, $bootstrap->dumper->parse());
    }

    public function testTable()
    {
        $markdown="|heading one|heading two|heading three|
|row1 col1|row1 col2|row1 col3|
|row2 col1|row2 col2|row2 col3|
";
        $markup='<table border="border"><thead><th>heading one</th><th>heading two</th><th>heading three</th></thead><tbody><tr><td>row1 col1</td><td>row1 col2</td><td>row1 col3</td></tr><tr><td>row2 col1</td><td>row2 col2</td><td>row2 col3</td></tr></tbody></table><br />';
        $bootstrap=new BootStrap($markdown);
        $this->assertEquals($markup, $bootstrap->dumper->parse());
    }

    public function testStrikeThrough()
    {
        $markdown='~~strike~~';
        $markup='<del>strike</del>';
        $bootstrap=new BootStrap($markdown);
        $this->assertEquals($markup, $bootstrap->dumper->parse());
    }
}