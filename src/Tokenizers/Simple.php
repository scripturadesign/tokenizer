<?php
/**
 * Copyright (c) 2016 Martin Dilling-Hansen <martindilling@gmail.com>
 * https://github.com/scripturadesign/tokenizer
 */

namespace Scriptura\Tokenizer\Tokenizers;

use Scriptura\Tokenizer\Tokenizer;

class Simple implements Tokenizer
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
        $string = $this->wrapInSpaces($string);
        $string = $this->spaceBeforeContractions($string);
        $string = $this->concatenateDoubleOrMoreSpaces($string);
        $string = $this->removeStartingAndEndingSpaces($string);

        return explode(' ', $string);
    }

    protected function wrapInSpaces($string)
    {
        return ' ' . $string . ' ';
    }

    protected function spaceBeforeContractions($string)
    {
        // Special cases
        $string = preg_replace('/[^\w](AI)(N\'T) /', ' AM ${2} ', $string);
        $string = preg_replace('/[^\w](ai)(n\'t) /i', ' am ${2} ', $string);
        $string = preg_replace('/[^\w](ca(n))(\'t) /i', ' ${1} ${2}${3} ', $string);


        // The rest
        $string = preg_replace('/(\'[sSmMdD]) /', ' ${1} ', $string);
        $string = preg_replace('/(\'ll|\'LL|\'re|\'RE|\'ve|\'VE|n\'t|N\'T) /', ' ${1} ', $string);

        return $string;
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
