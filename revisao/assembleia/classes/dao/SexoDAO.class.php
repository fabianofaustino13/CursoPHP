<?php
    require_once (__DIR__ . "/./Conexao.class.php");
    require_once (__DIR__ . "/../modelo/Sexo.class.php");

    class SexoDAO {

        public function findAll() {
            $sql = "SELECT * FROM TB_SEXOS";
            $statement = Conexao::get()->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll();
            $sexos = array();
            foreach ($result as $row) {
                $sexo = new Sexo();
                $sexo->setId($row['PK_SEX']);
                $sexo->setNome($row['SEX_NOME']);
                $sexo->setSigla($row['SEX_SIGLA']);
                array_push($sexos, $sexo);
            }
            return $sexos;
        }

        public function findById($id) {
            $sql = "SELECT * FROM TB_SEXOS WHERE PK_SEX = $id";
            $statement = Conexao::get()->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll();
            $sexo = new Sexo();
            foreach ($result as $row) {
                $sexo->setId($row['PK_SEX']);
                $sexo->setNome($row['SEX_NOME']);
                $sexo->setSigla($row['SEX_SIGLA']);
                //array_push($sexos, $sexo);
            }
            return $sexo;
        }

        public function findByNome($nome) {
            $sql = "SELECT * FROM TB_SEXOS WHERE SEX_NOME = '$nome'";
            $statement = Conexao::get()->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll();
            $sexo = new Sexo();
            foreach ($result as $row) {
                $sexo->setId($row['PK_SEX']);
                $sexo->setNome($row['SEX_NOME']);
                $sexo->setSigla($row['SEX_SIGLA']);
                //array_push($sexos, $sexo);
            }
            return $sexo;
        }

        public function save(Sexo $sexo) {
            if ($sexo->getId() == null) {
                $this->insert($sexo);
            } else {
                $this->update($sexo);
            }
        }

        private function insert(Sexo $sexo) {
            $sql = "INSERT INTO TB_SEXOS (SEX_NOME, SEX_SIGLA) VALUES ('{$sexo->getNome()}', '{$sexo->getSigla()}')";
            try {
                Conexao::get()->exec($sql);
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }

        private function update(Sexo $sexo) {
            $sql = "UPDATE TB_SEXOS SET SEX_NOME ='{$sexo->getNome()}', SEX_SIGLA = '{$sexo->getSigla()}' WHERE PK_SEX='{$sexo->getId()}'";
            try {
                Conexao::get()->exec($sql);
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function remove($id) {
            $sql = "DELETE FROM TB_SEXOS WHERE PK_SEX=$id";
            try {
                Conexao::get()->exec($sql);
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    }
?>