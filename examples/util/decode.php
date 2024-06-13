<?php

require_once(__DIR__ . "/../../bootstrap.php");

use CloudDfe\SdkPHP\Util;

/**
 * Este exemplo faz o decode em base64 de uma string, caso venha compactado/zipado o processo ira fazer essa decodificação
 */
try {
    // exemplo base64 + compactado/zipado
    $data = 'H4sIAAAAAAAAAytJLS7JV0hUKE4tUkhJTc5PyUzLTE5MyQcAc8pGehgAAAA=';
    // exemplo de base64
    $data = 'dGVzdG8gYSBzZXIgZGVjb2RpZmljYWRv';

    $resp = Util::decode($data);

    echo "<pre>";
    print_r($resp);
    echo "</pre>";
} catch (\Exception $e) {
    echo $e->getMessage();
}
