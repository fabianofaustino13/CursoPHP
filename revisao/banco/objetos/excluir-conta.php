<?php

require_once 'classes/Cliente.class.php';
require_once 'classes/ContaCorrente.class.php';
require_once 'classes/BancoDB.class.php';

//var_dump($_POST['conta']);

$conta = $_POST['conta'];

$banco = new BancoDB();

$exclui = $banco->excluiContaPorNumero($conta);

var_dump($exclui);


