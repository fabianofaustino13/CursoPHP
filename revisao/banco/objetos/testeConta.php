<pre>
<?php

require_once 'classes/Cliente.class.php';
require_once 'classes/Conta.class.php';
require_once 'classes/Corrente.class.php';
require_once 'classes/Poupanca.class.php';
require_once 'classes/Acoes.class.php';


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

try {
    $contaFabiano->saca("Teste");
} catch (Exception $erro) {
    echo "Falha: {$erro->getMessage()} <br>";
    echo "Linha: {$erro->getLine()}, do Arquivo: {$erro->getFile()} <br><br>";
}


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

$clienteCarlaFalcao = new Cliente();
$clienteCarlaFalcao->setNome('Carla Falcão');
$clienteCarlaFalcao->setEmail('carla.falcao@ifrn.edu.br');

$acoesCarlaFalcao = new Acoes();
$acoesCarlaFalcao->setCliente($clienteCarlaFalcao);
$acoesCarlaFalcao->setAgencia('1111');
$acoesCarlaFalcao->setNumero('222222-2');
$acoesCarlaFalcao->setSaldo(2000);


// $contaFabiano->transfere(0.0, $contaCarla);
// $contaCarla->transfere(0.0,$contaMariaClara);

// $contaMariaClara->rende();
// $acoesCarlaFalcao->rende();

//$contaFabiano->setCliente($cliente);

//var_dump($contaBanco);

//var_dump($contaFabiano);
var_dump($contaCarla);
//var_dump($contaMariaClara);
//var_dump($acoesCarlaFalcao);
echo "Parabéns, você é o cliente número " . Corrente::getQuantidadeContas();

// echo "Nome: {$contaFabiano->getNome()}<br>CPF: {$contaFabiano->getCpf()} <br>E-mail: {$contaFabiano->getEmail()} <br>Agência: {$contaFabiano->getAgencia()} <br>Conta: {$contaFabiano->getNumero()} <br>";
//echo "<br><br>", $contaBanco;

?>
</pre>