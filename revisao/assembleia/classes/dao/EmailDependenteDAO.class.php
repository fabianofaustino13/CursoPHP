<?php
require_once(__DIR__ . "/./Conexao.class.php");
require_once(__DIR__ . "/../modelo/Dependente.class.php");
require_once(__DIR__ . "/../modelo/EmailDependente.class.php");

class EmailDependenteDAO {
    public function findAll() {
        $sql = "SELECT * FROM tb_emails_dependentes LEFT JOIN tb_dependentes ON PK_DEP = FK_EDD_DEP";
        $statement = Conexao::get()->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll();
        $emails = array();
        foreach($result as $row) {
            $dependente = new Dependente();
            $dependente->setId($row['PK_DEP']);
            $dependente->setNome($row['DEP_NOME']);
            $dependente->setCpf($row['DEP_CPF']);
            $email = new EmailDependente();
            $email->setDependente($dependente);
            $email->setEmail($row['FDD_EMAILS']);
            array_push($emails, $email);
        }
        return $emails;
    }

    public function findById($id) {
        $sql = "SELECT * FROM tb_emails_dependentes LEFT JOIN tb_dependentes ON PK_DEP = FK_EDD_DEP WHERE FK_EDD_DEP = :id";
        $statement = Conexao::get()->prepare($sql);
        $statement->bindParam(":id", $id);
        $statement->execute();
        $row = $statement->fetch();
        $dependente = new Dependente();
        $dependente->setId($row['PK_DEP']);
        $dependente->setNome($row['DEP_NOME']);
        $dependente->setCpf($row['DEP_CPF']);
        $email = new EmailDependente();
        $email->setDependente($dependente);
        $email->setEmail($row['FDD_EMAILS']);
        return $email;
    }

    public function findByDependente(Dependente $id) {
        $sql = "SELECT * FROM tb_emails_dependentes LEFT JOIN tb_dependentes ON PK_DEP = FK_EDD_DEP WHERE PK_DEP = :dep_id";
        $statement = Conexao::get()->prepare($sql);
        $dep_id = $id->getId();
        $statement->bindParam(":dep_id", $dep_id);
        $statement->execute();
        $result = $statement->fetchAll();
        $emails = array();
        foreach($result as $row) {
            $dependente = new Dependente();
            $dependente->setId($row['PK_DEP']);
            $dependente->setNome($row['DEP_NOME']);
            $dependente->setCpf($row['DEP_CPF']);
            $email = new EmailDependente();
            $email->setDependente($dependente);
            $email->setEmail($row['FDD_EMAILS']);
            array_push($emails, $email);
        }
        return $emails;
    }

    public function insert(EmailDependente $emailDependente) {
        $sql = "INSERT INTO tb_emails_dependentes (FK_EDD_DEP, FDD_EMAILS) VALUES (:id, :email)";
        try {
            $statement = Conexao::get()->prepare($sql);
            $dep_id = $emailDependente->getDependente()->getId();
            $dep_email = $emailDependente->getEmail();
            $statement->bindParam(":id", $dep_id);
            $statement->bindParam(":email", $dep_email);
            $statement->execute();
        } catch(PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }
    public function update(EmailDependente $emailDependente) {
        $sql = "UPDATE TB_EMAILS_DEPENDENTES SET FDD_EMAILS = :new_email WHERE FK_EDD_DEP = :dep_id AND FDD_EMAILS = :email";
        try {
            $statement = Conexao::get()->prepare($sql);
            $new_email = $emailDependente->setEmail();
            $dep_id = $emailDependente->getDependente()->getId();
            $email = $emailDependente->getEmail();
            $statement->bindParam(":new_email", $new_email);
            $statement->bindParam(":dep_id", $dep_id);
            $statement->bindParam(":email", $email);
            $statement->execute();
        } catch(PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }

    public function remove($email) {
        $sql = "DELETE FROM tb_emails_dependentes WHERE FDD_EMAILS = :email";
        try {
            $statement = Conexao::get()->prepare($sql);
            $statement->bindParam(":email", $email);
            $statement->execute();
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
}