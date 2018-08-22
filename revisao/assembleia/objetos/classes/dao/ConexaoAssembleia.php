<?php

$servidor = "localhost";
$usuario = "root";
$senha = "";
$db = "db_assembleia";

try {
    $conn = new PDO("mysql:host=$servidor; dbname=$db", $usuario, $senha);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo("Conexão com sucesso!!!");
} catch(PDOException $error) {
    echo("Falha na conexão!!!");
    echo("Motivo: {$error->getMessage()}");
}