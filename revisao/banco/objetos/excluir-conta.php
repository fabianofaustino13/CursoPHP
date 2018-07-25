<?php

require_once 'classes/BancoDB.class.php';

$conta = $_POST['conta'];
$banco = new BancoDB();
$banco->excluiContaPorNumero($conta);
header('location:index.php');