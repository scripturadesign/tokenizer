<?php
/**
 * Copyright (c) 2016 Martin Dilling-Hansen <martindilling@gmail.com>
 * https://github.com/scripturadesign/tokenizer
 */

namespace Scriptura\Tokenizer;

interface Tokenizer
{
    /**
     * Get the token sequence from a character sequence
     *
     * @param string $string
     *
     * @return array
     */
    public function tokenize($string);
}
