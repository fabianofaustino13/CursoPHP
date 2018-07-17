<pre>
<?php

require_once 'classes/Cliente.class.php';
require_once 'classes/Conta.class.php';
require_once 'classes/Corrente.class.php';
require_once 'classes/Poupanca.class.php';
require_once 'classes/Acoes.class.php';
require_once 'classes/BancoDB.class.php';

$clienteFabiano = new Cliente();
$clienteFabiano->setNome('Fabiano');
$clienteFabiano->setCpf('696.284.592-87');

$contaFabiano = new Corrente();
$contaFabiano->setCliente($clienteFabiano);
$contaFabiano->setAgencia('8082-9');
$contaFabiano->setNumero('6681-8');
$contaFabiano->setSaldo(500);

$banco = new BancoDB();
$banco->salva($contaFabiano);


?>
</pre>