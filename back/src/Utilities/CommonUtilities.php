<?php

namespace App\Utilities;

trait CommonUtilities
{
    public function stripSpecial(string $string): ?string
    {
        return str_replace(['"', '\'', "\n", "\r", '[', ']'], '', $string);
    }
}
