<?php

/*
 * This file is part of yuml-php
 *
 * (c) Robert Schönthal <seroscho@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace YumlPhp\Tests\Builder;

use Buzz\Browser;
use YumlPhp\Builder\BuilderInterface;
use YumlPhp\Builder\Http\ActivityBuilder;
use YumlPhp\Builder\HttpBuilder;
use YumlPhp\Request\Http\FileRequest;

/**
 * @covers YumlPhp\Builder\HttpBuilder<extended>
 */
class HttpBuilderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var BuilderInterface
     */
    private $builder;

    /**
     * @var Browser
     */
    private $browser;

    public function setUp()
    {
        $this->browser = $this->getMock('Buzz\\Browser');
        $this->builder = new HttpBuilder(new FileRequest(), $this->browser, 'test');
    }

    public function testType()
    {
        $this->assertEquals('test', $this->builder->getType());
    }

    public function testRequest()
    {
        $response = $this->getMock('Buzz\Message\Response');
        $response->expects($this->atLeastOnce())->method('getStatusCode')->will($this->returnValue(201));
        $response->expects($this->atLeastOnce())->method('getContent')->will($this->returnValue('foo'));

        $this->browser->expects($this->atLeastOnce())->method('post')->will($this->returnValue($response));

        $result = $this->builder
            ->configure(array(
                'url'   => 'http://lolcathost',
                'debug' => false
            ))
            ->setPath(sys_get_temp_dir())
            ->build();

        $this->assertInternalType('array', $result);
        $this->assertGreaterThan(0, count($result));

        $this->assertEquals(array(
            '<info>PNG</info> http://yuml.me/foo',
            '<info>URL</info> http://yuml.me/edit/foo',
            '<info>PDF</info> http://yuml.me/foo'
        ), $result);
    }
}