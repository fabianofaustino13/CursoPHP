<?php
    require_once(__DIR__ . "/./Conexao.class.php");
    require_once(__DIR__ . "/../modelo/Funcionario.class.php");
    require_once(__DIR__ . "/../modelo/Sexo.class.php");
    require_once(__DIR__ . "/../modelo/Cep.class.php");
    require_once(__DIR__ . "/../modelo/Bairro.class.php");
    require_once(__DIR__ . "/../modelo/Cidade.class.php");
    require_once(__DIR__ . "/../modelo/Estado.class.php");

    class FuncionarioDAO {

        private $conexao;

        function __construct() {
            $this->conexao = Conexao::get();
        }
        
        public function findAll() {
            $sql = "SELECT * FROM TB_VENDEDORES LEFT JOIN TB_SEXOS ON PK_SEX = FK_VEN_SEX LEFT JOIN TB_CEPS ON PK_CEP = FK_VEN_CEP LEFT JOIN TB_BAIRROS ON PK_BAI = FK_BAI_CEP LEFT JOIN TB_CIDADES ON PK_CID = FK_BAI_CID LEFT JOIN TB_ESTADOS ON PK_EST = FK_EST_CID ORDER BY PK_VEN ASC";
            $statement = $this->conexao->prepare($sql);
            $statement->execute();
            $rows = $statement->fetchAll();
            $vendedores = array();
            foreach ($rows as $row) {
                $sexo = new Sexo();
                $sexo->setId($row['PK_SEX']);
                $sexo->setNome($row['SEX_NOME']);
                $sexo->setSigla($row['SEX_SIGLA']);           
                
                $estado = new Estado();
                $estado->setId($row['PK_EST']);
                $estado->setNome($row['EST_NOME']);
                $estado->setSigla($row['EST_SIGLA']);
                
                $cidade = new Cidade();
                $cidade->setId($row['PK_CID']);
                $cidade->setNome($row['CID_NOME']);
                $cidade->setEstado($estado);
                
                $bairro = new Bairro();
                $bairro->setId($row['PK_BAI']);
                $bairro->setNome($row['BAI_NOME']);
                $bairro->setCidade($cidade);

                $cep = new Cep();
                $cep->setId($row['PK_CEP']);
                $cep->setLogradouro($row['CEP_LOGRADOURO']);
                $cep->setBairro($bairro);
                
                $vendedor = new Vendedor();
                $vendedor->setId($row['PK_VEN']);
                $vendedor->setNome($row['VEN_NOME']);
                $vendedor->setCpf($row['VEN_CPF']);
                $vendedor->setMatricula($row['VEN_MATRICULA']);
                $vendedor->setSexo($sexo);
                $vendedor->setCep($cep);
                array_push($vendedores, $vendedor);
            }
            return $vendedores;
        }

        public function findById($id) {
            $sql = "SELECT * FROM TB_VENDEDORES LEFT JOIN TB_SEXOS ON PK_SEX = FK_VEN_SEX LEFT JOIN TB_CEPS ON PK_CEP = FK_VEN_CEP LEFT JOIN TB_BAIRROS ON PK_BAI = FK_BAI_CEP LEFT JOIN TB_CIDADES ON PK_CID = FK_BAI_CID LEFT JOIN TB_ESTADOS ON PK_EST = FK_EST_CID WHERE PK_VEN = :ID";
            $statement = $this->conexao->prepare($sql);
            $statement->bindParam(':ID', $id); //Proteção contra sql injetct
            $statement->execute();
            $row = $statement->fetch();
            $sexo = new Sexo();
            $sexo->setId($row['PK_SEX']);
            $sexo->setNome($row['SEX_NOME']);
            $sexo->setSigla($row['SEX_SIGLA']);
            $vendedor = new Vendedor();
            $vendedor->setId($row['PK_VEN']);
            $vendedor->setNome($row['VEN_NOME']);
            $vendedor->setCpf($row['VEN_CPF']);
            $vendedor->setMatricula($row['VEN_MATRICULA']);
            $vendedor->setSexo($sexo);
            
            return $vendedor;
        }

        public function findByNome($nome) {
            $sql = "SELECT * FROM TB_VENDEDORES LEFT JOIN TB_SEXOS ON PK_SEX = FK_VEN_SEX LEFT JOIN TB_CEPS ON PK_CEP = FK_VEN_CEP LEFT JOIN TB_BAIRROS ON PK_BAI = FK_BAI_CEP LEFT JOIN TB_CIDADES ON PK_CID = FK_BAI_CID LEFT JOIN TB_ESTADOS ON PK_EST = FK_EST_CID WHERE VEN_NOME LIKE :NOME";
            $statement = $this->conexao->prepare($sql);
            $statement->bindParam(':NOME', $nome); //Proteção contra sql injetct
            $statement->execute();
            $rows = $statement->fetchAll();
            $sexo = new Sexo();
            $vendedor = new Vendedor();
            foreach ($rows as $row) {
                $vendedor->setId($row['PK_VEN']);
                $vendedor->setNome($row['VEN_NOME']);
                $vendedor->setCpf($row['VEN_CPF']);
                $vendedor->setMatricula($row['VEN_MATRICULA']);
                $vendedor->setSexo()->setId($row['PK_SEX']);
                $vendedor->setSexo()->setNome($row['SEX_NOME']);
                $vendedor->setSexo()->setSigla($row['SEX_SIGLA']);
            }
            return $vendedor;
        }

        public function save(Vendedor $vendedor) {
            if ($vendedor->getId() == null) {
                $this->insert($vendedor);
            } else {
                $this->update($vendedor);
            }
        }

        private function insert(Vendedor $vendedor) {
            $sql = "INSERT INTO TB_VENDEDORES (VEN_NOME, VEN_CPF, VEN_MATRICULA, FK_VEN_SEX) VALUES (:NOME, :CPF, :MATRICULA, :SEXO)";
            try {
                $statement = $this->conexao->prepare($sql);
                $nome = $vendedor->getNome();
                $cpf = $vendedor->getCpf();
                $matricula = $vendedor->getMatricula();
                $sexoId = $vendedor->getSexo()->getId();                
                $statement->bindParam(':NOME', $nome);
                $statement->bindParam(':CPF', $cpf);
                $statement->bindParam(':MATRICULA', $matricula);
                $statement->bindParam(':SEXO', $sexoId);
                $statement->execute();
                return $this->findById($this->conexao->lastInsertId());
            } catch(PDOException $e) {
                echo $e->getMessage();
                return null;
            }
        }

        private function update(Vendedor $vendedor) {
            $sql = "UPDATE TB_VENDEDORES SET VEN_NOME=:NOME, VEN_CPF=:CPF, VEN_MATRICULA=:MATRICULA, FK_VEN_SEX=:SEXO WHERE PK_VEN = :ID";
            try {
                $statement = $this->conexao->prepare($sql);
                $nome = $vendedor->getNome();
                $cpf = $vendedor->getCpf();
                $matricula = $vendedor->getMatricula();
                $sexo = $vendedor->getSexo()->getId();
                $id = $vendedor->getId();
                $statement->bindParam(':NOME', $nome);
                $statement->bindParam(':CPF', $cpf);
                $statement->bindParam(':MATRICULA', $matricula);
                $statement->bindParam(':SEXO', $sexo);
                $statement->bindParam(':ID', $id);
                $statement->execute();
                return $this->findById($vendedor->getId());
                } catch(PDOException $e) {
                echo $e->getMessage();
                return null;
            }
        }

        public function remove($id) {
            $sql = "DELETE FROM TB_VENDEDORES WHERE PK_VEN = :ID";
            try {
                $statement = $this->conexao->prepare($sql);
                $statement->bindParam(':ID', $id); //Proteção contra sql injetct
                $statement->execute();
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    }
?>