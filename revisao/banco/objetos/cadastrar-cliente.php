<pre>
<?php

require_once 'classes/Cliente.class.php';
require_once 'classes/Conta.class.php';
require_once 'classes/ContaCorrente.class.php';
require_once 'classes/Poupanca.class.php';
require_once 'classes/Acoes.class.php';
require_once 'classes/BancoDB.class.php';
require_once 'classes/ChecaDados.class.php';

$nomeCliente = $_REQUEST['nome'];
if (!empty($nomeCliente) && $nomeCliente != '') {
    var_dump($nomeCliente);
} else {
    echo "erro";
}
// $cpfCliente = $_REQUEST['cpf'];
// $agenciaCliente = $_REQUEST['agencia'];
// $numeroContaCliente = $_REQUEST['numero-conta'];
// $saldoCliente = $_REQUEST['saldo'];

// $cliente = new Cliente();
// $checaCpf = new ChecaDados();
// try {
//     $testeCpf = $checaCpf->validaCpf($cpfCliente);
//     if ($testeCpf) {
//         $cliente->setCpf($cpfCliente);
//     }
// } catch (Exception $erro) {
//     echo "Falha: {$erro->getMessage()} <br>";
//     echo "Linha: {$erro->getLine()}, do Arquivo: {$erro->getFile()} <br><br>";
//     //header('location: Conta.php');
// }

?>
</pre>