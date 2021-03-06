<?php

namespace YumlPhp\Tests\Request;

use YumlPhp\Request\Console\ClassesRequest;

/**
 * FileRequestTest.
 *
 * @author Robert Schönthal <seroscho@googlemail.com>
 *
 * @covers YumlPhp\Request\Console\ClassesRequest<extended>
 */
class ConsoleClassesRequestTest extends \PHPUnit_Framework_TestCase
{
    public function testBuild()
    {
        $request = new ClassesRequest();
        $request->configure([
            'withProperties' => true,
            'withMethods'    => true,
        ]);
        $request->setPath(__DIR__ . '/../Fixtures');

        $this->assertEquals([
            '<info>YumlPhp/Tests/Fixtures/BarWithExternal</info><comment> Symfony/Component/Console/Input/StringInput</comment>',
            "\t<info>+</info>bar;<question>-</question>foo",
            "\t<info>+</info>bar();<question>-</question>foo()",
            '<info><<YumlPhp/Tests/Fixtures/BarWithInterface>></info><comment></comment> <<YumlPhp/Tests/Fixtures/BarInterface>>',
            "\t<info>+</info>bar;<question>-</question>foo",
            "\t<info>+</info>bar();<question>-</question>foo()",
            '<info>YumlPhp/Tests/Fixtures/Bar</info><comment></comment>',
            "\t<info>+</info>bar;<question>-</question>foo",
            "\t<info>+</info>bar();<question>-</question>foo()",
            '<info>YumlPhp/Tests/Fixtures/Bazz</info><comment></comment>',
            '<info><<YumlPhp/Tests/Fixtures/FooBazzWithInterface>></info><comment> YumlPhp/Tests/Fixtures/Bazz</comment> <<YumlPhp/Tests/Fixtures/BazzInterface>>',
            "\t<info>+</info>bar;<question>-</question>foo",
            "\t<info>+</info>bar();<question>-</question>foo()",
            '<info>YumlPhp/Tests/Fixtures/Foo</info><comment> YumlPhp/Tests/Fixtures/Bazz</comment>',
            "\t<info>+</info>bar;<question>-</question>foo",
            "\t<info>+</info>bar();<question>-</question>foo()",
            '<info><<YumlPhp/Tests/Fixtures/FooWithInterface>></info><comment></comment> <<YumlPhp/Tests/Fixtures/BazzInterface>> <<YumlPhp/Tests/Fixtures/FooInterface>>',
            "\t<info>+</info>bar();<info>+</info>foo()",
            '<info><<YumlPhp/Tests/Fixtures/BarInterface>></info><comment></comment>',
            '<info><<YumlPhp/Tests/Fixtures/BazzInterface>></info><comment></comment>',
            '<info><<YumlPhp/Tests/Fixtures/FooInterface>></info><comment></comment> <<YumlPhp/Tests/Fixtures/BazzInterface>>',
        ], array_values($request->build()));
    }
}
