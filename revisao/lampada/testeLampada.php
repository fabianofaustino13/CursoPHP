<?php

require_once 'Lampada.php';

$liga = $_POST[liga];
$desliga = $_POST[desliga];

$lampada = new Lampada();

$lampada->setPotencia(50);
if ($liga) {
    $lampada->liga();
} else {
    $lampada->desliga();
}

echo $lampada;

// echo "O estado da lâmpada é {$lampada->estado} <br>";
// echo "A potência da lâmpada é {$lampada->getPotencia()}";