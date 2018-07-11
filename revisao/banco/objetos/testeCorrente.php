<?php

require_once 'classes/Pessoa.class.php';
require_once 'classes/Conta.class.php';
require_once 'classes/Corrente.class.php';

$corrente = new Corrente('8082-9', '6681-8', '001', 1000);
$cliente = new Pessoa();
$cliente->setNome('Fabiano');
$corrente->setSaldo(0);
$corrente->setDeposito(100);
$corrente->setSaque(2000);

echo "Nome: {$corrente->getNome()} <br> Idade: {$corrente->getIdade()} <br> Sexo: {$corrente->getSexo()} <br> CPF: {$corrente->getCpf()} <br> Agência: {$corrente->getAgencia()} <br> Corrente: {$corrente->getConta()} <br> Operação: {$corrente->getOperacao()} <br> Limite: {$corrente->getLimite()} <br> Deposito: {$corrente->getDeposito()} <br> Saque: {$corrente->getSaque()}  <br> Saldo: {$corrente->getSaldo()} <br> Saldo Total: {$corrente->getSaldoTotal()}";
echo "<br><br>", $corrente;

?>