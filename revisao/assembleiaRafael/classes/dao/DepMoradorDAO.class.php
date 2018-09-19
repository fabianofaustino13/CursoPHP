<?php
require_once(__DIR__ . "/./Conexao.class.php");
require_once(__DIR__ . "/../modelo/Morador.class.php");
require_once(__DIR__ . "/../modelo/Dependente.class.php");
require_once(__DIR__ . "/../modelo/DepMorador.class.php");

class DepMoradorDAO {
    public function findAll() {
        $sql = "SELECT * FROM TB_DEPENDENTES LEFT JOIN TB_DEPENDENTES_MORADORES ON PK_DEP = FK_DDM_DEP LEFT JOIN TB_MORADORES ON PK_MOR = FK_DDM_MOR";
        $statement = Conexao::get()->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll();
        $depsMorador = array();
        foreach ($result as $row) {
            $dependente = new Dependente();
            $dependente->setId($row['PK_DEP']);
            $dependente->setNome($row['DEP_NOME']);
            $dependente->setCpf($row['DEP_CPF']);
            $morador = new Morador();
            $morador->setId($row['PK_MOR']);
            $morador->setNome($row['MOR_NOME']);
            $depMorador = new DepMorador();
            $depMorador->setDependente($dependente);
            $depMorador->setMorador($morador);
            array_push($depsMorador, $depMorador);
        }
        return $depsMorador;
    }

    public function findById(Dependente $dependente) {
        $sql = "SELECT * FROM TB_DEPENDENTES LEFT JOIN TB_DEPENDENTES_MORADORES ON PK_DEP = FK_DDM_DEP LEFT JOIN TB_MORADORES ON PK_MOR = FK_DDM_MOR WHERE PK_DEP = :dep_id";
        $statement = Conexao::get()->prepare($sql);
        $dep_id = $dependente->getId();
        $statement->bindParam(":dep_id", $dep_id);
        $statement->execute();
        $row = $statement->fetch();
        $dependente = new Dependente();
        $dependente->setId($row['PK_DEP']);
        $dependente->setNome($row['DEP_NOME']);
        $dependente->setCpf($row['DEP_CPF']);
        $morador = new Morador();
        $morador->setId($row['PK_MOR']);
        $morador->setNome($row['MOR_NOME']);
        $depMorador = new DepMorador();
        $depMorador->setDependente($dependente);
        $depMorador->setMorador($morador);
        return $depMorador;
    }

    public function findByDependente(Dependente $dependente) {
        $sql = "SELECT * FROM TB_DEPENDENTES LEFT JOIN TB_DEPENDENTES_MORADORES ON PK_DEP = FK_DDM_DEP LEFT JOIN TB_MORADORES ON PK_MOR = FK_DDM_MOR WHERE PK_DEP = :dep_id";
        $statement = Conexao::get()->prepare($sql);
        $dep_id = $dependente->getId();
        $statement->bindParam(":dep_id", $dep_id);
        $statement->execute();
        $result = $statement->fetchAll();
        $depsMorador = array();
        foreach ($result as $row) {
            $dependente = new Dependente();
            $dependente->setId($row['PK_DEP']);
            $dependente->setNome($row['DEP_NOME']);
            $dependente->setCpf($row['DEP_CPF']);
            $morador = new Morador();
            $morador->setId($row['PK_MOR']);
            $morador->setNome($row['MOR_NOME']);
            $depMorador = new DepMorador();
            $depMorador->setDependente($dependente);
            $depMorador->setMorador($morador);
            array_push($depsMorador, $depMorador);
        }
        return $depsMorador;
    }

    public function save(DepMorador $depMorador) {
        if ($depMorador->getMorador()->getId() || $depMorador->getDependente()->getId() == null) {
            $this->insert($depMorador);
        } else {
            $this->update($depMorador);
        }
    }

    public function insert(DepMorador $depMorador) {
        $sql = "INSERT INTO tb_dependentes_moradores (FK_DDM_DEP, FK_DDM_MOR) VALUES (:id_dep, :id_mor)";
        try {
            $statement = Conexao::get()->prepare($sql);
            $id_dep = $depMorador->getDependente()->getId();
            $id_mor = $depMorador->getMorador()->getId();
            $statement->bindParam(":id_dep", $id_dep);
            $statement->bindParam(":id_mor", $id_mor);
            $statement->execute();
        } catch(PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }
    private function update(DepMorador $depMorador) {
        $sql = "UPDATE tb_dependentes_moradores SET FK_DDM_DEP = :id_dep, FK_DDM_MOR = :id_mor WHERE FK_DDM_DEP = :id_dep AND FK_DDM_MOR = :id_mor";
        try {
            $statement = Conexao::get()->prepare($sql);
            $id_dep = $depMorador->getDependente()->getId();
            $id_mor = $depMorador->getMorador()->getId();
            $statement->bindParam(":id_dep", $id_dep);
            $statement->bindParam(":id_mor", $id_mor);
            $statement->execute();
        } catch(PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }
    
    public function remove($dep_id, $mor_id) {
        $sql = "DELETE FROM tb_dependentes_moradores WHERE FK_DDM_DEP = :dep_id AND FK_DDM_MOR = :mor_id";
        try {
            $statement = Conexao::get()->prepare($sql);
            $statement->bindParam(":dep_id", $dep_id);
            $statement->bindParam(":mor_id", $mor_id);
            $statement->execute();
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }
}