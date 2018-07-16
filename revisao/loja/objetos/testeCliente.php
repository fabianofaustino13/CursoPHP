<pre>
<?php

require_once 'classes/Clientes.class.php';

$clienteFabiano = new Clientes();
$clienteFabiano->setNome('Fabiano');
$clienteFabiano->setCpf('696.284.592-87');
$clienteFabiano->setEmail('ffo13@hotmail.com');

var_dump($clienteFabiano);


?>
</pre>