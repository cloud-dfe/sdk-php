<?php

require_once(__DIR__ . "/../../bootstrap.php");

use CloudDfe\SdkPHP\Util;

/**
 * Este exemplo faz o encode em base64 de uma string
 */
try {
    $data = 'testo a ser codificado';
    $resp = Util::encode($data);

    echo "<pre>";
    print_r($resp);
    echo "</pre>";
} catch (\Exception $e) {
    echo $e->getMessage();
}
