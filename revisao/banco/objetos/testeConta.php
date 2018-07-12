<pre>
<?php

require_once 'classes/Cliente.class.php';
require_once 'classes/Conta.class.php';
require_once 'classes/Corrente.class.php';
require_once 'classes/Poupanca.class.php';

//$conta = new Conta('Fabiano', 37, 'm', '12345678900', '8082-9', '6681-8');
$clienteFabiano = new Cliente();
$clienteFabiano->setNome('Fabiano');
$clienteFabiano->setEmail('ffo13@hotmail.com');

$contaFabiano = new Corrente();
$contaFabiano->setCliente($clienteFabiano);
$contaFabiano->setAgencia('8082-9');
$contaFabiano->setNumero('6681-8');
$contaFabiano->setSaldo(500);
$contaFabiano->setLimite(1000);


$clienteCarla = new Cliente();
$clienteCarla->setNome('Carla');
$clienteCarla->setEmail('carla.falcao@gmail.com');

$contaCarla = new Corrente();
$contaCarla->setCliente($clienteCarla);
$contaCarla->setAgencia('1406');
$contaCarla->setNumero('20804-1');
$contaCarla->setSaldo(1000);
$contaCarla->setLimite(2000);

$clienteMariaClara = new Cliente();
$clienteMariaClara->setNome('Maria Clara');
$clienteMariaClara->setEmail('maria.clara@gmail.com');

$contaMariaClara = new Poupanca();
$contaMariaClara->setCliente($clienteMariaClara);
$contaMariaClara->setAgencia('2595');
$contaMariaClara->setNumero('300208');
$contaMariaClara->setSaldo(1000);

$contaFabiano->transfere(0.0, $contaCarla);
$contaCarla->transfere(500.0,$contaMariaClara);

$contaMariaClara->setRende(10);

//$contaFabiano->setCliente($cliente);

//var_dump($contaBanco);

// var_dump($contaFabiano);
// var_dump($contaCarla);
var_dump($contaMariaClara);

// echo "Nome: {$contaFabiano->getNome()}<br>CPF: {$contaFabiano->getCpf()} <br>E-mail: {$contaFabiano->getEmail()} <br>Agência: {$contaFabiano->getAgencia()} <br>Conta: {$contaFabiano->getNumero()} <br>";
//echo "<br><br>", $contaBanco;

?>
</pre>