<?php
session_start();
require_once 'classes/Cliente.class.php';
require_once 'classes/ContaCorrente.class.php';
require_once 'classes/BancoDB.class.php';

$continua = true;

if (empty($_POST['nome']) && isset($_POST['nome'])) {
    $_SESSION['vazio_nome'] = "O nome é obrigatório";
    $continua = false;
    header('location: index.php');
} else {
    $_SESSION['value_nome'] = $_POST['nome'];
}
if (empty($_POST['cpf']) &&  isset($_POST['cpf'])) {
    $_SESSION['vazio_cpf'] = "CPF é obrigatório";
    $continua = false;
    header('location: index.php');
} else {
    $_SESSION['value_cpf'] = $_POST['cpf'];
}

if (empty($_POST['agencia']) && isset($_POST['agencia'])) {
    $_SESSION['vazio_agencia'] = "Número da Agência é obrigatório";
    $continua = false;
    header('location: index.php');
} else {
    $_SESSION['value_agencia'] = $_POST['agencia'];
}

if (empty($_POST['conta']) && isset($_POST['conta'])) {
    $_SESSION['vazio_conta'] = "Número da Conta é obrigatório";
    $continua = false;
    header('location: index.php');
} else {
    $_SESSION['value_conta'] = $_POST['conta'];
}

if ($continua){
    $cliente = new Cliente();
    $cliente->setNome($_POST['nome']);
    $cliente->setCpf($_POST['cpf']);

    $conta = new ContaCorrente();
    $conta->setCliente($cliente);
    $conta->setAgencia($_POST['agencia']);
    $conta->setNumero($_POST['conta']);

    $banco = new BancoDB();
    $banco->salva($conta);

    header('location: index.php');
}

