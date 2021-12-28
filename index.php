<?php

require __DIR__.'/vendor/autoload.php';

use App\Validation\CPF;

$resultado = CPF::validar("890.957.910-25");

var_dump($resultado);