<?php
class Conexao {
    public static function get() {
        $servidor = "localhost";
        $usuario = "root";
        $senha = "";
        $db = "db_loja";
        try {
            $conn = new PDO("mysql:host=$servidor; dbname=$db", $usuario, $senha);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo("Conexão com sucesso!!!");
            return $conn;
        } catch(PDOException $error) {
            //echo("Falha na conexão!!!");
            echo("Motivo: {$error->getMessage()}");
            return null;
        }
    }
}

