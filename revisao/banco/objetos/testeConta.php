<?php

require_once 'classes/Conta.class.php';

$conta = new Conta('Fabiano', 37, 'm', '12345678900', '8082-9', '6681-8');

echo "Nome: {$conta->getNome()} <br> Idade: {$conta->getIdade()} <br> Sexo: {$conta->getSexo()} <br> CPF: {$conta->getCpf()} <br> Agência: {$conta->getAgencia()} <br> Conta: {$conta->getConta()}";
echo "<br><br>", $conta;

?>