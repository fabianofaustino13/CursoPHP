<?php

require_once 'classes/BancoDB.class.php';

$cliente = new Cliente();
$cliente->setNome($_POST['nome']);
$cliente->setCpf($_POST['cpf']);

$conta = new ContaCorrente();
$conta->setCliente($cliente);
$conta->setAgencia($_POST['agencia']);
$conta->setNumero($_POST['numero']);
$conta->setSaldo($_POST['saldo']);

$banco = new BancoDB();
$banco->editaContaPorNumero($conta);

header('location:index.php');