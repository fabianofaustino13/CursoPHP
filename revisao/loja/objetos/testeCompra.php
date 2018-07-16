<pre>
<?php

require_once 'classes/SecaoProdutos.class.php';
require_once 'classes/Produtos.class.php';
require_once 'classes/Clientes.class.php';
require_once 'classes/Compra.class.php';

$secaoProdutos1 = new SecaoProdutos();
$secaoProdutos1->setNomeSecao('Eletrônicos');

$produto1 = new Produtos();
$produto1->setSecaoProduto($secaoProdutos1);
$produto1->setNomeProduto('Smartphone');
$produto1->setPrecoProduto(500.0);

$secaoProdutos2 = new SecaoProdutos();
$secaoProdutos2->setNomeSecao('Móveis');

$produto2 = new Produtos();
$produto2->setSecaoProduto($secaoProdutos2);
$produto2->setNomeProduto('Sofá');
$produto2->setPrecoProduto(1200.0);

$clienteFabiano = new Clientes();
$clienteFabiano->setNome('Fabiano');
$clienteFabiano->setCpf('696.284.592-87');
$clienteFabiano->setEmail('ffo13@hotmail.com');

$compraFabiano = new Compra();
$compraFabiano->setClienteCompra($clienteFabiano);
$compraFabiano->setProdutoCompra($produto1);

var_dump($compraFabiano);
// var_dump($clienteFabiano);
// var_dump($produto1);
// var_dump($produto2);


?>
</pre>