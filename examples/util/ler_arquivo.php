<?php

require_once(__DIR__ . "/../../bootstrap.php");

use CloudDfe\SdkPHP\Util;

/**
 * Este exemplo faz a leitura de um arquivo
 */
try {

    // representa o caminho relativo do arquivo
    $resp = Util::read_file('/home/usuario/arquivo.txt');

    echo "<pre>";
    print_r($resp);
    echo "</pre>";
} catch (\Exception $e) {
    echo $e->getMessage();
}
