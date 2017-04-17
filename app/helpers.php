<?php

if ( ! function_exists('strip_whitespace'))
{
    /**
     * Strips excessive whitespace from a string.
     *
     * @param  string  $str
     * @return string
     */
    function strip_whitespace(string $str): string
    {
        $str = preg_replace('/\s+/', ' ', $str);
        $str = trim($str);

        return $str;
    }
}
