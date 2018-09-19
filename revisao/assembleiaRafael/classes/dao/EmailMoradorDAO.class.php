<?php
require_once(__DIR__ . "/./Conexao.class.php");
require_once(__DIR__ . "/../modelo/Morador.class.php");
require_once(__DIR__ . "/../modelo/EmailMorador.class.php");

class EmailMoradorDAO {
    public function findAll() {
        $sql = "SELECT * FROM tb_emails_moradores LEFT JOIN tb_moradores ON PK_MOR = FK_EDM_MOR";
        $statement = Conexao::get()->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll();
        $emails = array();
        foreach($result as $row) {
            $morador = new Morador();
            $morador->setId($row['PK_MOR']);
            $morador->setNome($row['MOR_NOME']);
            $email = new EmailMorador();
            $email->setMorador($morador);
            $email->setEmail($row['EDM_EMAIL']);
            array_push($emails, $email);
        }
        return $emails;
    }

    public function findById($id) {
        $sql = "SELECT * FROM tb_emails_moradores LEFT JOIN tb_moradores ON PK_MOR = FK_EDM_MOR WHERE FK_EDM_MOR = :id";
        $statement = Conexao::get()->prepare($sql);
        $statement->bindParam(":id", $id);
        $statement->execute();
        $row = $statement->fetch();
        $morador = new Morador();
        $morador->setId($row['PK_MOR']);
        $morador->setNome($row['MOR_NOME']);
        $email = new EmailMorador();
        $email->setMorador($morador);
        $email->setEmail($row['EDM_EMAIL']);
        return $email;
    }
    
    public function findByMorador(Morador $id) {
        $sql = "SELECT * FROM tb_emails_moradores LEFT JOIN tb_moradores ON PK_MOR = FK_EDM_MOR WHERE PK_MOR = :mor_id";
        $statement = Conexao::get()->prepare($sql);
        $mor_id = $id->getId();
        $statement->bindParam(":mor_id", $mor_id);
        $statement->execute();
        $result = $statement->fetchAll();
        $emails = array();
        foreach($result as $row) {
            $morador = new Morador();
            $morador->setId($row['PK_MOR']);
            $morador->setNome($row['MOR_NOME']);
            $email = new EmailMorador();
            $email->setMorador($morador);
            $email->setEmail($row['EDM_EMAIL']);
            array_push($emails, $email);
        }
        return $emails;
    }

    public function insert(EmailMorador $emailMorador) {
        $sql = "INSERT INTO tb_emails_moradores (FK_EDM_MOR, EDM_EMAIL) VALUES (:id, :email)";
        try {
            $statement = Conexao::get()->prepare($sql);
            $id = $emailMorador->getMorador()->getId();
            $email = $emailMorador->getEmail();
            $statement->bindParam(":id", $id);
            $statement->bindParam(":email", $email);
            $statement->execute();
        } catch(PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }

    public function remove($email) {
        $sql = "DELETE FROM tb_emails_moradores WHERE EDM_EMAIL = :email";
        try {
            $statement = Conexao::get()->prepare($sql);
            $statement->bindParam(":email", $email);
            $statement->execute();
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
}