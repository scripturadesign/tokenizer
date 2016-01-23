<?php

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
