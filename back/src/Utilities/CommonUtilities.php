<?php

namespace App\Utilities;

trait CommonUtilities
{
    public function stripSpecial(string $string): ?string
    {
        return str_replace(['"', '\'', "\n", "\r", '[', ']'], '', $string);
    }

    public function createResponse(string $result, string $type, string $message): ?string
    {
        return '{"result":"' . $result . '","type":"' . $type . '","message":"' . $message . '"}}';
    }
}
