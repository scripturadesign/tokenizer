<?php
/**
 * Copyright (c) 2016 Martin Dilling-Hansen <martindilling@gmail.com>
 * https://github.com/scripturadesign/tokenizer
 */

namespace Scriptura\Tokenizer\Tests\Tokenizers;

use Scriptura\Tokenizer\Tokenizers\Whitespace;

class WhitespaceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Assert that tokenizing a string gives the correct array back.
     *
     * @param string $actual
     * @param array $expected
     */
    protected function assertTokenizing($actual, $expected)
    {
        $tokenizer = new Whitespace();

        assertThat($tokenizer->tokenize($actual), is($expected));
    }

    /**
     * @test
     * @covers \Scriptura\Tokenizer\Tokenizers\Whitespace::tokenize
     * @covers \Scriptura\Tokenizer\Tokenizers\Whitespace::<protected>
     */
    public function trim_whitespace_before_text()
    {
        $this->assertTokenizing(
            '    Hello world',
            ['Hello', 'world']
        );
    }

    /**
     * @test
     * @covers \Scriptura\Tokenizer\Tokenizers\Whitespace::tokenize
     * @covers \Scriptura\Tokenizer\Tokenizers\Whitespace::<protected>
     */
    public function trim_whitespace_after_text()
    {
        $this->assertTokenizing(
            'Hello world    ',
            ['Hello', 'world']
        );
    }

    /**
     * @test
     * @covers \Scriptura\Tokenizer\Tokenizers\Whitespace::tokenize
     * @covers \Scriptura\Tokenizer\Tokenizers\Whitespace::<protected>
     */
    public function trim_whitespace_to_one_space_in_text()
    {
        $this->assertTokenizing(
            '  Hello  beautiful   world  ',
            ['Hello', 'beautiful', 'world']
        );
    }
}
