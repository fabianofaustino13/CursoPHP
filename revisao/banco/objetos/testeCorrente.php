<?php

require_once 'classes/Cliente.class.php';
require_once 'classes/Conta.class.php';
require_once 'classes/Corrente.class.php';

$conta = new Conta();
$conta->setAgencia('8082-9');

$corrente = new Corrente();
$corrente->setSaldo(2000);
$corrente->setLimite(1000);
$corrente->setDeposito(300);
$corrente->setSaque(1550);

$cliente = new Cliente();
$cliente->setNome('Fabiano');

echo "Nome: {$cliente->getNome()}<br> E-mail: {$cliente->getEmail()} <br> Agência: {$conta->getAgencia()} <br> Corrente: {$corrente->getNumero()} <br> Operação: {$corrente->getOperacao()} <br> Limite: {$corrente->getLimite()} <br> Deposito: {$corrente->getDeposito()} <br> Saldo: {$corrente->getSaldo()} <br> Saldo com Limite: {$corrente->getSaldoTotal()} <br> Saque: {$corrente->getSaque()}";
//echo "<br><br>", $corrente;

?>