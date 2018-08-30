<?php
class Conexao {
    private const SERVER = "localhost";
    private const USER = "root";
    private const PASS = "";
    private const FUSO = "utf8";
    private const DB = "db_loja";
    private const URL = "mysql:host=" . self::SERVER . ";dbname=" . self::DB . ";charset=" . self::FUSO;
    private static $conexao;
    public static function get() {
        try {
            if (!isset(self::$conexao)) {
                self::$conexao = new PDO(self::URL, self::USER, self::PASS);
                self::$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            return self::$conexao;
        } catch(PDOException $error) {
            echo "Conexão falhou: {$error->getMessage()}";
            return null;
        }
    }
}

