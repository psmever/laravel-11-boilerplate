<?php

namespace App\Helpers;

class PolyHelper
{
    /**
     * 기본 암호화
     * base 64 encode
     * @param string $plainText
     * @return string
     */
    public static function base64Encode(string $plainText): string
    {
        return rtrim(strtr(base64_encode($plainText), '+/', '-_'), '=');
    }

    /**
     * 기본 디코딩
     * base 64 decode
     * @param string $base64Text
     * @return string
     */
    public static function base64Decode(string $base64Text): string
    {
        return base64_decode(str_pad(strtr($base64Text, '-_', '+/'), strlen($base64Text) % 4, '=', STR_PAD_RIGHT));
    }
}
