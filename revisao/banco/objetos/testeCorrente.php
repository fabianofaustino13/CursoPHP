<pre>

<?php

require_once 'classes/Cliente.class.php';
require_once 'classes/Conta.class.php';
require_once 'classes/ContaCorrente.class.php';

// $conta = new Corrente();
// $conta->setAgencia('8082-9');

$cliente = new Cliente();
$cliente->setNome('Fabiano');
$corrente = new ContaCorrente();
$corrente->setCliente($cliente);
$corrente->setAgencia('8082-9');
$corrente->setNumero('6681-8');
$corrente->setSaldo(1000.0);
$corrente->setLimite(500.0);
$corrente->saca(1100.0);
//$corrente->setDeposito(0);
//$corrente->setSaque(500);


var_dump($corrente);

echo "<br>Agência: {$corrente->getAgencia()} <br>Corrente: {$corrente->getNumero()} <br>Limite: {$corrente->getLimite()} <br>Saldo: {$corrente->getSaldo()}";
//echo "<br><br>", $corrente;

?>

</pre>