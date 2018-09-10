<?php
require_once(__DIR__ . "/../classes/modelo/Funcionario.class.php");
require_once(__DIR__ . "/../classes/dao/FuncionarioDAO.class.php");
require_once(__DIR__ . "/../classes/modelo/Sexo.class.php");
require_once(__DIR__ . "/../classes/dao/SexoDAO.class.php");
require_once(__DIR__ . "/../classes/modelo/Cep.class.php");
require_once(__DIR__ . "/../classes/dao/CepDAO.class.php");
require_once(__DIR__ . "/../classes/modelo/Bairro.class.php");
require_once(__DIR__ . "/../classes/dao/BairroDAO.class.php");
require_once(__DIR__ . "/../classes/modelo/Cidade.class.php");
require_once(__DIR__ . "/../classes/dao/CidadeDAO.class.php");
require_once(__DIR__ . "/../classes/modelo/Estado.class.php");
require_once(__DIR__ . "/../classes/dao/EstadoDAO.class.php");

include(__DIR__ . "/../administracao/logado.php");

// $home = "/cursoPHP/loja/vendedor/";
$fucionario = new Funcionario();
$cep = new Cep();
$bairro = new Bairro();
$cidade = new Cidade();
$estado = new Estado();
$sexoDao = new SexoDAO();
$cepDao = new CepDao();
$bairroDAO = new BairroDAO;
$cidadeDAO = new CidadeDAO;
$estadoDAO = new EstadoDAO;
$funcionarioDao = new FuncionarioDAO();

if (isset($_POST['editar']) && $_POST['editar'] == 'editar') {
    $fucionario = $fucionarioDao->findById($_POST['id']);
}

if (isset($_POST['excluir']) && $_POST['excluir'] == 'excluir') {
    $fucionarioDao->remove($_POST['id']);
    header('location: index.php');
}

if (isset($_POST['salvar']) && $_POST['salvar'] == 'salvar') {
    $fucionario->setMatricula($_POST['matricula']);
    $fucionario->setNome($_POST['nome']);
    $fucionario->setCpf($_POST['cpf']);
    $fucionario->setLogradouro($_POST['logradouro']);
    $fucionario->setNumero($_POST['numero']);
    $fucionario->setComplemento($_POST['complemento']);
    $fucionario->setDataAdmissao($_POST['dataAdmissao']);
    $fucionario->setDataDemissao($_POST['dataDemissao']);
    $fucionario->getSexo()->setId($_POST['sexoId']);
    $cidade->getEstado()->setId($_POST['estadoId']);
    $bairro->getCidade()->setId($cidade);
    $cep->getBairro()->setId($bairro);
    $fucionario->getCep()->setId($cep);

    // $produto->getDepartamento()->setId($_POST['departamentoId']);
    // if ($produto->getDepartamento()->getId() == 0) {
    //     $produto->getDepartamento()->setId(null);
    // }

    // if ($_POST['id'] != '') {
    //     $fucionario->setMatricula($_POST['id']);
    // }
    $fucionarioDao->save($fucionario);
    header('location: index.php');
}

$fucionarios = $fucionarioDao->findAll();
$sexos = $sexoDao->findAll();
// $ceps = $cepDao->findAll();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/css/all.css">

</head>
<body>
    <?php
        include(__DIR__ . "/../administracao/menu.php");
        
    ?>
    <div class="container-fluid" style="padding: 2% 2% 0 2%;">
        <div class="row">
            <div class="col-4"><!-- form -->
                <fieldset>
                    <legend>Dados do Vendedor</legend>
                    <form action="index.php" method="post" id="form-salvar">
                        <div class="row">
                            <input type="hidden" name="id" value="<?=$funcionario->getMatricula();?>">
                            <div class="form-group col-md-12 mb-3"> <!-- input Vendedor -->
                                <label for="nome" class="required">Nome</label >
                                <input type="text" class="form-control" name="nome" id="nome" maxlength="70" required value="<?=$funcionario->getNome();?>" placeholder="Nome completo">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="sexoId" class="required">Sexo</label><br><!-- input Sexo -->
                                <div class="form-group">
                                    <?php foreach ($sexos as $sexo): ?>
                                        <div class="custom-control custom-radio custom-control-inline">                                    
                                            <input type="radio" id="<?=$sexo->getNome();?>" name="sexoId" value="<?=$sexo->getId();?>" class="custom-control-input" <?php if ($sexo->getId() == 1):?> checked <?php endif;?> <?=$sexo->getId() == $vendedor->getSexo()->getId() ? "checked": "";?>/>
                                            <label class="custom-control-label" for="<?=$sexo->getNome();?>"><?=$sexo->getNome();?></label>
                                        </div>
                                    <?php endforeach; ?>                                    
                                </div>
                            </div>  
                            <div class="form-group col-md-3 mb-3"> <!-- input CPF -->
                                <label for="cpf">CPF</label >
                                <input type="text" class="form-control" name="cpf" id="cpf" maxlength="11" value="<?=$funcionario->getCpf();?>" placeholder="Números">
                            </div>
                            <div class="form-group col-md-3 mb-3"> <!-- input Matrícula -->
                                <label for="matricula">Matrícula</label >
                                <input type="text" class="form-control" name="matricula" id="matricula" maxlength="10" value="<?=$funcionario->getMatricula();?>" placeholder="Números">
                            </div>   
                        </div>                    
                        <div class="row">
                            <div class="form-group col-md-9 mb-3"> <!-- input Logradouro -->
                                <label for="logradouro">Logradouro</label >
                                <input type="text" class="form-control" name="logradouro" id="logradouro" maxlength="50" value="<?=$funcionario->getLogradouro();?>">
                            </div>
                            <div class="form-group col-md-3 mb-3"> <!-- input Número do endereço -->
                                <label for="numero">Número</label >
                                <input type="text" class="form-control" name="numero" id="numero" maxlength="10" value="<?=$funcionario->getNumero();?>">
                            </div>  
                        </div>
                        <div class="row">
                            <div class="form-group col-md-8 mb-3"> <!-- input Complemento -->
                                <label for="complemento">Complemento</label >
                                <input type="text" class="form-control" name="complemento" id="complemento" maxlength="40" value="<?=$funcionario->getComplemento();?>">
                            </div> 
                            <div class="form-group col-md-4 mb-3"> <!-- input Complemento -->
                                <label for="cepId">CEP</label >
                                <input type="text" class="form-control" name="cepId" id="cepId" maxlength="8" value="<?=$funcionario->getComplemento();?>" placeholder="Números">
                            </div> 
                        </div>
                        <!--  -->
                        <div class="form-group"> <!-- Botão -->
                            <button type="submit" class="btn btn-primary btn-block" name="salvar" value="salvar" onclick="return confirmaSalvar();">
                                <i class="fas fa-save"></i> Salvar
                            </button>
                        </div>
                    </form>
                </fieldset>
            </div>
            <div class="col-8"><!-- table -->
                <fieldset>
                    <legend>Lista de Vendedores</legend>
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>CPF</th>
                                <th>MATRÍCULA</th>
                                <th>SEXO</th>                                
                                <th colspan="2">ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($vendedores as $vendedor): ?>
                                <tr>
                                    <td><?=$vendedor->getId();?></td>
                                    <td><?=$vendedor->getNome();?></td>
                                    <td><?=$vendedor->getCpf();?></td>
                                    <td><?=$vendedor->getMatricula();?></td>
                                    <td><?=$vendedor->getSexo()->getNome();?></td>
                                    <td>
                                        <form action="index.php" method="post" id="form-editar">
                                            <input type="hidden" name="id" value="<?=$vendedor->getId();?>">
                                            <button type="submit" class="btn btn-sm btn-success" name="editar" value="editar"><i class="fas fa-edit"></i></button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="index.php" method="post" id="form-remover">
                                            <input type="hidden" name="id" value="<?=$vendedor->getId();?>">
                                            <button type="submit" class="btn btn-sm btn-danger" name="excluir" value="excluir" onclick="return confirmaRemover();"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </fieldset>
            </div>
        </div> <!--Div Row -->
    </div>
    <script src="../assets/js/produto.js"></script>
</body>
</html>