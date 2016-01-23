<?php
/**
 * Copyright (c) 2016 Martin Dilling-Hansen <martindilling@gmail.com>
 * https://github.com/scripturadesign/tokenizer
 */

namespace Scriptura\Tokenizer\Tokenizers;

use Scriptura\Tokenizer\Tokenizer;

class Whitespace implements Tokenizer
{
    /**
     * Get the token sequence from a character sequence
     *
     * @param string $string
     *
     * @return array
     */
    public function tokenize($string)
    {
        $string = $this->concatenateDoubleOrMoreSpaces($string);
        $string = $this->removeStartingAndEndingSpaces($string);

        return explode(' ', $string);
    }

    protected function concatenateDoubleOrMoreSpaces($string)
    {
        return preg_replace('/  +/', ' ', $string);
    }

    protected function removeStartingAndEndingSpaces($string)
    {
        return trim($string);
    }
}
