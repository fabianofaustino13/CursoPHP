<?php

require_once 'classes/Pessoa.class.php';

$pessoa = new Pessoa('Fabiano', 'm', 37);

echo "Nome: {$pessoa->getNome()}, Idade: {$pessoa->getIdade()}, Sexo: {$pessoa->getSexo()}";

?>