<?php

/*
 * This file is part of yuml-php
 *
 * (c) Robert Schönthal <seroscho@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace YumlPhp\Tests\Request;

use YumlPhp\Request\Http\ClassesRequest;

/**
 * FileRequestTest
 *
 * @author Robert Schönthal <seroscho@googlemail.com>
 *
 * @covers YumlPhp\Request\Http\ClassesRequest<extended>
 */
class HttpClassesRequestTest extends \PHPUnit_Framework_TestCase
{
    public function testBuild()
    {
        $request = new ClassesRequest();
        $request->setPath(__DIR__ . '/../Fixtures');

        $expected = array(
            '[<<YumlPhp/Tests/Fixtures/BazzInterface>>]^-.-[<<YumlPhp/Tests/Fixtures/FooInterface>>{bg:orange}]',
            '[<<YumlPhp/Tests/Fixtures/BazzInterface>>{bg:orange}]',
            '[<<YumlPhp/Tests/Fixtures/BarInterface>>{bg:orange}]',
            '[YumlPhp/Tests/Fixtures/Bar]',
            '[Symfony/Component/Console/Input/StringInput]^[YumlPhp/Tests/Fixtures/BarWithExternal]',
            '[<<YumlPhp/Tests/Fixtures/BarInterface>>]^-.-[YumlPhp/Tests/Fixtures/BarWithInterface]',
            '[YumlPhp/Tests/Fixtures/Bazz]',
            '[YumlPhp/Tests/Fixtures/Bazz]^[YumlPhp/Tests/Fixtures/Foo]',
            '[YumlPhp/Tests/Fixtures/Bazz]^[<<YumlPhp/Tests/Fixtures/BazzInterface>>]^-.-[YumlPhp/Tests/Fixtures/FooBazzWithInterface]',
            '[<<YumlPhp/Tests/Fixtures/FooInterface>>]^-.-[;<<YumlPhp/Tests/Fixtures/BazzInterface>>]^-.-[YumlPhp/Tests/Fixtures/FooWithInterface]'
        );
        $current = $request->build();

        sort($expected);
        sort($current);
        $this->assertEquals($expected, $current);
    }
}