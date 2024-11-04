<?php

namespace CloudDfe\SdkPHP;

class Util
{
    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public static function encode($data)
    {
        return base64_encode($data);
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public static function decode($data)
    {
        $decoded = @base64_decode($data);
        $gz = @gzdecode($decoded);
        if ($gz !== false) {
            return $gz;
        }
        return $decoded;
    }

    // @param array $payload
    // @return \stdClass
    // @throws \Exception
    public static function read_file($file)
    {
        return file_get_contents($file);
    }
}
