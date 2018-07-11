<?php

require_once 'classes/Pessoa.class.php';

$pessoa = new Pessoa('Fabiano', 37, 'm', '12345678900');

echo "Nome: {$pessoa->getNome()}, Idade: {$pessoa->getIdade()}, Sexo: {$pessoa->getSexo()}, CPF: {$pessoa->getCpf()}";

?>