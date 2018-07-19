<pre>
<?php

require_once 'classes/Cliente.class.php';
require_once 'classes/Conta.class.php';
require_once 'classes/Corrente.class.php';
require_once 'classes/Poupanca.class.php';
require_once 'classes/Acoes.class.php';
require_once 'classes/BancoDB.class.php';
require_once 'classes/ChecaDados.class.php';

$nomeCliente = $_REQUEST['nome'];
$cpfCliente = $_REQUEST['cpf'];
$agenciaCliente = $_REQUEST['agencia'];
$numeroContaCliente = $_REQUEST['numero-conta'];
$saldoCliente = $_REQUEST['saldo'];

$cliente = new Cliente();
$checaCpf = new ChecaDados();
try {
    $testeCpf = $checaCpf->validaCpf($cpfCliente);
    if ($testeCpf) {
        $cliente->setCpf($cpfCliente);
    }
} catch (Exception $erro) {
    echo "Falha: {$erro->getMessage()} <br>";
    echo "Linha: {$erro->getLine()}, do Arquivo: {$erro->getFile()} <br><br>";
    //header('location: Conta.php');
}


// $cliente->setNome($nomeCliente);

// $conta = new Corrente();
// $conta->setCliente($cliente);
// $conta->setAgencia($agenciaCliente);
// $conta->setNumero($numeroContaCliente);
// $conta->setSaldo($saldoCliente);

// $clienteFabiano = new Cliente();
// $clienteFabiano->setNome('Fabiano');
// $clienteFabiano->setCpf('696.284.592-87');

// $contaFabiano = new Corrente();
// $contaFabiano->setCliente($clienteFabiano);
// $contaFabiano->setAgencia('8082-9');
// $contaFabiano->setNumero('6681-8');
// $contaFabiano->setSaldo(500);

// $banco = new BancoDB();
// $banco->salva($conta);

// $clienteCarla = new Cliente();
// $clienteCarla->setNome('Carla Falcão');
// $clienteCarla->setCpf('931.205.673-53');

// $contaCarla = new Corrente();
// $contaCarla->setCliente($clienteCarla);
// $contaCarla->setAgencia('1406');
// $contaCarla->setNumero('20804-1');
// $contaCarla->setSaldo(1000);

//$banco->salva($contaCarla);

//ar_dump($banco->listaTodas());

//var_dump($banco->obterContaCliente('6681-8'));
//var_dump($banco->obterNomeCliente('Carla Falcão'));



?>
</pre>