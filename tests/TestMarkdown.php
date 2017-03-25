<?php
/**
 * @author natedrake
 * @date 25/03/2017
 */
namespace Markdown\Test;

use Markdown\BootStrap;
use PHPUnit\Framework\TestCase;

/**
 * Class TestMarkdown
 * @author natedrake
 * @date 11/03/2017
 */
class TestMarkdown extends TestCase
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
}