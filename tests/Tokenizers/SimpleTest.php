<?php
/**
 * Copyright (c) 2016 Martin Dilling-Hansen <martindilling@gmail.com>
 * https://github.com/scripturadesign/tokenizer
 */

namespace Scriptura\Tokenizer\Tests\Tokenizers;

use Scriptura\Tokenizer\Tokenizers\Simple;

class SimpleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Assert that tokenizing a string gives the correct array back.
     *
     * @param string $actual
     * @param array $expected
     */
    protected function assertTokenizing($actual, $expected)
    {
        $tokenizer = new Simple();

        assertThat($tokenizer->tokenize($actual), is($expected));
    }

    /**
     * @test
     * @covers \Scriptura\Tokenizer\Tokenizers\Simple::tokenize
     * @covers \Scriptura\Tokenizer\Tokenizers\Simple::<protected>
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
     * @covers \Scriptura\Tokenizer\Tokenizers\Simple::tokenize
     * @covers \Scriptura\Tokenizer\Tokenizers\Simple::<protected>
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
     * @covers \Scriptura\Tokenizer\Tokenizers\Simple::tokenize
     * @covers \Scriptura\Tokenizer\Tokenizers\Simple::<protected>
     */
    public function trim_whitespace_to_one_space_in_text()
    {
        $this->assertTokenizing(
            '  Hello   beautiful   world  ',
            ['Hello', 'beautiful', 'world']
        );
    }

    /**
     * @test
     * @covers \Scriptura\Tokenizer\Tokenizers\Simple::tokenize
     * @covers \Scriptura\Tokenizer\Tokenizers\Simple::<protected>
     */
    public function splits__s__contractions()
    {
        $this->assertTokenizing(
            "No he's not",
            ['No', 'he', '\'s', 'not']
        );

        $this->assertTokenizing(
            "NO HE'S NOT",
            ['NO', 'HE', '\'S', 'NOT']
        );
    }

    /**
     * @test
     * @covers \Scriptura\Tokenizer\Tokenizers\Simple::tokenize
     * @covers \Scriptura\Tokenizer\Tokenizers\Simple::<protected>
     */
    public function splits__m__contractions()
    {
        $this->assertTokenizing(
            "Yeah I'm here",
            ['Yeah', 'I', '\'m', 'here']
        );

        $this->assertTokenizing(
            "YEAH I'M HERE",
            ['YEAH', 'I', '\'M', 'HERE']
        );
    }

    /**
     * @test
     * @covers \Scriptura\Tokenizer\Tokenizers\Simple::tokenize
     * @covers \Scriptura\Tokenizer\Tokenizers\Simple::<protected>
     */
    public function splits__d__contractions()
    {
        $this->assertTokenizing(
            "How I'd do",
            ['How', 'I', '\'d', 'do']
        );

        $this->assertTokenizing(
            "HOW I'D DO",
            ['HOW', 'I', '\'D', 'DO']
        );
    }

    /**
     * @test
     * @covers \Scriptura\Tokenizer\Tokenizers\Simple::tokenize
     * @covers \Scriptura\Tokenizer\Tokenizers\Simple::<protected>
     */
    public function splits__ll__contractions()
    {
        $this->assertTokenizing(
            "Yes I'll go",
            ['Yes', 'I', '\'ll', 'go']
        );

        $this->assertTokenizing(
            "YES I'LL GO",
            ['YES', 'I', '\'LL', 'GO']
        );
    }

    /**
     * @test
     * @covers \Scriptura\Tokenizer\Tokenizers\Simple::tokenize
     * @covers \Scriptura\Tokenizer\Tokenizers\Simple::<protected>
     */
    public function splits__re__contractions()
    {
        $this->assertTokenizing(
            "Dude you're it",
            ['Dude', 'you', '\'re', 'it']
        );

        $this->assertTokenizing(
            "DUDE YOU'RE IT",
            ['DUDE', 'YOU', '\'RE', 'IT']
        );
    }

    /**
     * @test
     * @covers \Scriptura\Tokenizer\Tokenizers\Simple::tokenize
     * @covers \Scriptura\Tokenizer\Tokenizers\Simple::<protected>
     */
    public function splits__ve__contractions()
    {
        $this->assertTokenizing(
            "No you've got it",
            ['No', 'you', '\'ve', 'got', 'it']
        );

        $this->assertTokenizing(
            "NO YOU'VE GOT IT",
            ['NO', 'YOU', '\'VE', 'GOT', 'IT']
        );
    }

    /**
     * @test
     * @covers \Scriptura\Tokenizer\Tokenizers\Simple::tokenize
     * @covers \Scriptura\Tokenizer\Tokenizers\Simple::<protected>
     */
    public function splits__n_t__contractions()
    {
        $this->assertTokenizing(
            "They aren't here",
            ['They', 'are', 'n\'t', 'here']
        );

        $this->assertTokenizing(
            "THEY AREN'T HERE",
            ['THEY', 'ARE', 'N\'T', 'HERE']
        );
    }

    /**
     * @test
     * @covers \Scriptura\Tokenizer\Tokenizers\Simple::tokenize
     * @covers \Scriptura\Tokenizer\Tokenizers\Simple::<protected>
     */
    public function splits__n_t__contractions_special_case__am()
    {
        $this->assertTokenizing(
            "I ain't hungry",
            ['I', 'am', 'n\'t', 'hungry']
        );

        $this->assertTokenizing(
            "I AIN'T HUNGRY",
            ['I', 'AM', 'N\'T', 'HUNGRY']
        );
    }

    /**
     * @test
     * @covers \Scriptura\Tokenizer\Tokenizers\Simple::tokenize
     * @covers \Scriptura\Tokenizer\Tokenizers\Simple::<protected>
     */
    public function splits__n_t__contractions_special_case__can()
    {
        $this->assertTokenizing(
            "We can't go",
            ['We', 'can', 'n\'t', 'go']
        );

        $this->assertTokenizing(
            "WE CAN'T GO",
            ['WE', 'CAN', 'N\'T', 'GO']
        );
    }
}
