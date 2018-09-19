<?php
require_once(__DIR__ . "/./Conexao.class.php");
require_once(__DIR__ . "/../modelo/Dependente.class.php");
require_once(__DIR__ . "/../modelo/FoneDependente.class.php");

class FoneDependenteDAO {
    public function findAll() {
        $sql = "SELECT * FROM tb_fones_dependentes LEFT JOIN tb_dependentes ON PK_DEP = FK_FDD_DEP";
        $statement = Conexao::get()->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll();
        $fones = array();
        foreach($result as $row) {
            $dependente = new Dependente();
            $dependente->setId($row['PK_DEP']);
            $dependente->setNome($row['DEP_NOME']);
            $dependente->setCpf($row['DEP_CPF']);
            $fone = new FoneDependente();
            $fone->setDependente($dependente);
            $fone->setFone($row['FDD_FONE']);
            array_push($fones, $fone);
        }
        return $fones;
    }

    public function findById($id) {
        $sql = "SELECT * FROM tb_fones_dependentes LEFT JOIN tb_dependentes ON PK_DEP = FK_FDD_DEP WHERE FK_FDD_DEP = :id";
        $statement = Conexao::get()->prepare($sql);
        $statement->bindParam(":id", $id);
        $statement->execute();
        $row = $statement->fetch();
        $dependente = new Dependente();
        $dependente->setId($row['PK_DEP']);
        $dependente->setNome($row['DEP_NOME']);
        $dependente->setCpf($row['DEP_CPF']);
        $fone = new FoneDependente();
        $fone->setDependente($dependente);
        $fone->setFone($row['FDD_FONE']);
        return $fone;
    }

    public function findByDependente(Dependente $id) {
        $sql = "SELECT * FROM tb_fones_dependentes LEFT JOIN tb_dependentes ON PK_DEP = FK_FDD_DEP WHERE PK_DEP = :dep_id";
        $statement = Conexao::get()->prepare($sql);
        $dep_id = $id->getId();
        $statement->bindParam(":dep_id", $dep_id);
        $statement->execute();
        $result = $statement->fetchAll();
        $fones = array();
        foreach($result as $row) {
            $dependente = new Dependente();
            $dependente->setId($row['PK_DEP']);
            $dependente->setNome($row['DEP_NOME']);
            $dependente->setCpf($row['DEP_CPF']);
            $fone = new FoneDependente();
            $fone->setDependente($dependente);
            $fone->setFone($row['FDD_FONE']);
            array_push($fones, $fone);
        }
        return $fones;
    }

    public function insert(FoneDependente $foneDependente) {
        $sql = "INSERT INTO tb_fones_dependentes (FK_FDD_DEP, FDD_FONE) VALUES (:id, :fone)";
        try {
            $statement = Conexao::get()->prepare($sql);
            $dep_id = $foneDependente->getDependente()->getId();
            $dep_fone = $foneDependente->getFone();
            $statement->bindParam(":id", $dep_id);
            $statement->bindParam(":fone", $dep_fone);
            $statement->execute();
        } catch(PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }

    public function remove($fone) {
        $sql = "DELETE FROM tb_fones_dependentes WHERE FDD_FONE = :fone";
        try {
            $statement = Conexao::get()->prepare($sql);
            $statement->bindParam(":fone", $fone);
            $statement->execute();
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
}