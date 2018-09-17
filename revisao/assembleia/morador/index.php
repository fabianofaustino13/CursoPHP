<?php 
include(__DIR__ . "/../administracao/logado.php");

require_once(__DIR__ . "/../classes/modelo/Morador.class.php");
require_once(__DIR__ . "/../classes/dao/MoradorDAO.class.php");
require_once(__DIR__ . "/../classes/modelo/Apartamento.class.php");
require_once(__DIR__ . "/../classes/dao/ApartamentoDAO.class.php");
require_once(__DIR__ . "/../classes/modelo/Bloco.class.php");
require_once(__DIR__ . "/../classes/dao/BlocoDAO.class.php");
require_once(__DIR__ . "/../classes/modelo/Perfil.class.php");
require_once(__DIR__ . "/../classes/dao/PerfilDAO.class.php");

$perfil = new Perfil();
$perfilDao = new PerfilDAO();

$bloco = new Bloco();
$blocoDao = new BlocoDAO();

$apartamento = new Apartamento();
$apartamentoDao = new ApartamentoDAO();

$morador = new Morador();
$moradorDao = new MoradorDAO();
$teste = new Morador();
$aviso = '';


if (isset($_POST['salvar']) && $_POST['salvar'] == 'salvar') {
    $morador->setNome($_POST['nome']);
    $morador->setLogin($_POST['login']);
    $morador->setCpf($_POST['cpf']);
    $morador->setSenha($_POST['senha']);
    $morador->setStatus($_POST['sindico']);
    $perfil = $perfilDao->findById($_POST['perfil']);
    $morador->setPerfil($perfil);
    
    // $teste = $moradorDao->findByNome($_POST['nome']);
    // $i = count($teste);
    // if ($teste->count() > 0) {
    //     $aviso = "CPF já cadastrado";
    //     //return $aviso;
    // }else {

    // }


    if ($_POST['id'] != '') {
        $morador->setId($_POST['id']);
    }
    
    $apartamento->getBloco()->setId($_POST['blocoId']);
    $apartamento->setId($_POST['apartamentoId']);
       
    $moradorDao->save($morador, $apartamento); 
    
    header('location: index.php');
    } 
    
    if (isset($_POST['editar']) && $_POST['editar'] == 'editar') {
        $morador = $moradorDao->findByApartamento($_POST['id']);
        // $apartamento = $apartamentoDao->findByMorador($_POST['id']);
    }
    
    if (isset($_POST['excluir']) && $_POST['excluir'] == 'excluir') {
        $morador = $moradorDao->findByApartamento($_POST['id']);
        header('location: index.php');
    }
    
    $moradores = $moradorDao->findAll();
    $sindicos = $moradorDao->findSindico();
    $apartamentos = $apartamentoDao->findByMorador();
    $blocos = $blocoDao->findAll();
    $perfis = $perfilDao->findAll();
    date_default_timezone_set('America/Sao_Paulo');
    // $dataLocal = date('d/m/Y H:i:s', time());
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Cadastrar Morador</title>
    
</head>
<body>
    <!-- Início do container -->
    <div class="container-fluid">
   <!-- include Menu -->
   <?php
        include(__DIR__ . "/../administracao/menu.php");
    ?>

    <div class="containerMenuDireita">
        <div class="row" style="margin-top: 5%;">
            <div class="col-md-12 mb-3">
            <?php 
            // echo $aviso;
                echo "<pre>";
                
                    //var_dump($teste);
                
                echo "</pre>";
            ?>
            <!-- onsubmit="return checaFormulario()"  -->
                <fieldset>
                    <legend>Cadastro de Moradores</legend>
                    <!-- <form method="post" action="index.php">Form Geral -->
                    <form id="form1" name="form1" action="index.php" method="post" onsubmit="return checaFormulario(this)">
                        <div class="form-row"><!-- Div1 -->
                            
                            <div class="col-md-10 mb-3"><!-- Nome do Morador -->
                                <label for="nome" class="required">Nome</label>
                                <input type="hidden" name="id" value="<?=$morador->getId();?>">
                                <input type="text" class="form-control" id="nome" name="nome" value="<?=$morador->getNome();?>" maxlength="100" required />                    
                            </div>
                            <div class="col-md-2 mb-3"><!-- Nome do Morador -->
                                <label for="cpf" class="required">CPF</label>
                                <input type="text" class="form-control" id="cpf" name="cpf" value="<?=$morador->getCpf();?>" maxlength="11" required />                               
                            </div>
                        
                            <div class="col-md-4 mb-3">
                                <label for="login" class="required">Login</label>
                                <input type="text" class="form-control" id="login" name="login" value="<?=$morador->getLogin();?>" maxlength="25" required />
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="senha" class="required">Senha</label>
                                <input type="password" class="form-control" id="senha" name="senha" value="<?=$morador->getLogin();?>" maxlength="25" required />
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="senha2">Confirme a Senha</label>
                                <input type="password" class="form-control" id="senha2" name="senha2" value="<?=$morador->getLogin();?>" maxlength="25" required />
                            </div>      
                            <div class="col-md-2 mb-3" id="div_blocos"><!-- select Apartamento -->
                                <label for="blocoId" class="required">Bloco</label>
                                <select class="form-control" name="blocoId" onchange="show_apartamentos(this.value);" required />
                                    <!-- <option value="0" selected disabled>--Selecione um bloco--</option>-->
                                    <option value=""></option>
                                    <?php foreach ($blocos as $bloco): ?>                                                    
                                        <option id="<?=$bloco->getId();?>" value="<?=$bloco->getId();?>"><?=$bloco->getApelido();?></option> 
                                    <?php endforeach; ?>                                    
                                </select> 
                            </div>  
                            <div class="col-md-3 mb-3" id="div_apartamentos"><!-- select Apartamento -->
                                <label for="apartamentoId" class="required">Apartamento</label>
                                <select class="form-control" name="apartamentoId" required>
                                    <!-- <option value="0" selected disabled>--Selecione um bloco--</option>-->
                                    <option value="">--Selecione um bloco--</option>                      
                                </select> 
                            </div>  
                            <div class="col-md-2 mb-3"><!-- select Perfil -->
                                <label for="perfil">Perfil</label>
                                <select class="form-control" name="perfil">
                                    <!-- <option value="4" selected disabled>--SELECIONE--</option> -->
                                    <?php foreach ($perfis as $perfil): ?>                                                    
                                        <option id="<?=$perfil->getId();?>" value="<?=$perfil->getId();?>"><?=$perfil->getNome();?></option> 
                                    <?php endforeach; ?>                                    
                                </select> 
                            </div>  
                            <div class="col-md-4 mb-3">
                                <label class="required">Síndico?</label>
                                <div class="form-group">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="sindicoNao" name="sindico" class="custom-control-input" value="0" checked/>
                                        <label class="custom-control-label" for="sindicoNao">Não</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="sindicoSim" name="sindico" class="custom-control-input" value="1" />
                                        <label class="custom-control-label" for="sindicoSim">Sim</label>
                                    </div>      
                                </div>
                            </div> 
                        </div><!-- Fim Div1 -->
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block" name="salvar" value="salvar">Salvar</button>
                        </div><!-- Fim Botões -->
                    </form> <!-- Fim Form Geral -->
                </fieldset>
            </div>
            <div class="col-12"> <!-- Tabela -->
                <fieldset>
                    <legend>Lista dos Moradores</legend>
                    <table class="table table-striped table-hover">
                        <thead>
                            <th>#</th>
                            <th>Nome</th>
                            <th>Bloco</th>
                            <th>Apartamento</th>
                            <th colspan="2">Ações</th>
                        </thead>
                        <tbody>
                            <?php foreach ($apartamentos as $apartamento):?>
                                <tr>
                                    <td><?=$apartamento->getMorador()->getId()?></td>
                                    <td><?=$apartamento->getMorador()->getNome()?></td>
                                    <td><?=$apartamento->getBloco()->getApelido()?></td>
                                    <td><?=$apartamento->getNome()?></td>
                                    <td>
                                        <form method="post" action="index.php">
                                            <input type="hidden" name="id" value="<?=$apartamento->getId();?>">
                                            <button type="submit" class="btn btn-primary" name="editar" value="editar">
                                                <i class="far fa-edit"></i>
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <form method="post" action="index.php"> 
                                            <input type="hidden" name="id" value="<?=$apartamento->getId();?>">
                                            <button type="submit" class="btn btn-danger" name="excluir" value="excluir">
                                                <i class="far fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </fieldset>
            </div> <!-- Fim Tabela -->
        </div> 
    </div>
    </div> <!-- Fim do container -->
    <script src="../assets/js/ajax_funcoes.js"></script>
</body>
</html> 