<pre>
<?php

require_once 'classes/Corrente.class.php';
require_once 'classes/Conta.class.php';
require_once 'classes/Cliente.class.php';

//$conta = new Conta('Fabiano', 37, 'm', '12345678900', '8082-9', '6681-8');
$contaBanco = new conta();
$contaBanco->setAgencia('8082-9');
$contaBanco->setNumero('6681-8');
$contaBanco->setSaldo(500);

$cliente = new Cliente();
$cliente->setNome('Fabiano');
$cliente->setEmail('ffo13@hotmail.com');

$contaBanco->setCliente($cliente);

//var_dump($contaBanco);

echo "Nome: {$cliente->getNome()}<br>CPF: {$cliente->getCpf()} <br>E-mail: {$cliente->getEmail()} <br>Agência: {$contaBanco->getAgencia()} <br>Conta: {$contaBanco->getNumero()} <br>";
//echo "<br><br>", $contaBanco;

?>
</pre>