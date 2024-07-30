<?php

namespace CloudDfe\SdkPHP;

class Util
{
    /**
     * @param $data string
     * @return string
     */
    public static function encode($data)
    {
        return base64_encode($data);
    }

    /**
     * @param $data string
     * @return string
     */
    public static function decode($data)
    {
        $decoded = @base64_decode($data);
        $gz = @gzdecode($decoded);
        if ($gz !== false) {
            return $gz;
        }
        return $decoded;
    }

    /**
     * @param $data string
     * @return string
     */
    public static function read_file($file)
    {
        return file_get_contents($file);
    }
}
