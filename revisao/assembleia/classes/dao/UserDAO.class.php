<?php 
require_once (__DIR__ . "/./Conexao.class.php");
require_once (__DIR__ . "/../modelo/User.class.php");
require_once (__DIR__ . "/../modelo/Morador.class.php");

class UserDAO {

    private $conexao;

    function __construct() {
        $this->conexao = Conexao::get();
    }

    public function logar($login, $senha) {
        $usuario = $this->findByLogin($login);
        if ($usuario != null && $usuario->getSenha() == $senha) {
            return true;
        }
        return false;
    }

    public function findByLogin($login) {
        $sql = "SELECT * FROM TB_MORADORES WHERE MOR_LOGIN = :USERNAME";
        $statement = $this->conexao->prepare($sql);
        $statement->bindParam(':USERNAME', $login); //Proteção contra sql injetct
        $statement->execute();
        $result = $statement->fetchAll();
        $morador = new Morador();
        foreach ($result as $row) {
            $morador->setLogin($row['MOR_LOGIN']);
            $morador->setSenha($row['MOR_SENHA']);
        }
        return $morador;
    }
}