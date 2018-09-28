<?php 
session_start();
if ($_SESSION['MoradorStatus'] == NULL || $_SESSION['MoradorStatus'] == 2) {
    header('location: ../assembleia/aguardando.php');
}

include(__DIR__ . "/../administracao/logado.php");

require_once(__DIR__ . "/../classes/modelo/Morador.class.php");
require_once(__DIR__ . "/../classes/dao/MoradorDAO.class.php");
require_once(__DIR__ . "/../classes/modelo/Apartamento.class.php");
require_once(__DIR__ . "/../classes/dao/ApartamentoDAO.class.php");
require_once(__DIR__ . "/../classes/modelo/Bloco.class.php");
require_once(__DIR__ . "/../classes/dao/BlocoDAO.class.php");
require_once(__DIR__ . "/../classes/modelo/Perfil.class.php");
require_once(__DIR__ . "/../classes/dao/PerfilDAO.class.php");
require_once(__DIR__ . "/../classes/dao/MoradorRequisitadoDAO.class.php");

$perfil = new Perfil();
$perfilDao = new PerfilDAO();

$bloco = new Bloco();
$blocoDao = new BlocoDAO();

$apartamento = new Apartamento();
$apartamentoRequisitado = new Apartamento();
//$apartamentoDao = new ApartamentoDAO();

$morador = new Morador();
//$moradorDao = new MoradorDAO();
$requisitadoDao = new MoradorRequisitadoDAO();
$moradores = '';
if (isset($_POST['pesquisar']) && $_POST['pesquisar'] == 'pesquisar') {
    if ($_POST['pesquisar_cpf'] != '') {
        $moradores = $requisitadoDao->findAllMoradores();
        $morador = $requisitadoDao->findByCpf($_POST['pesquisar_cpf']);
        //$apartamentoRequisitado = $requisitadoDao->findByApartamentoMorador($morador->getId());
        //$apartamento = $apartamentoDao->findByMorador($_POST['id']);
    }  
}

if (isset($_POST['editar']) && $_POST['editar'] == 'editar') {
    $morador = $requisitadoDao->findById($_POST['id']);
    $apartamentoRequisitado = $requisitadoDao->findByApartamentoMorador($morador->getId());
    // $apartamento = $apartamentoDao->findByMorador($_POST['id']);
    // echo "<pre>";
    // var_dump($morador);
    // var_dump($apartamentoRequisitado);
    // echo "</pre>";
}

if (isset($_POST['excluir']) && $_POST['excluir'] == 'excluir') {
    //$morador = $moradorDao->findByApartamento($_POST['id']);
    header('location: index.php');
}

//$cpf = $moradorDao->findCpf('11111111111');
$apartamentos = $requisitadoDao->findAllApartamentos();
$blocos = $blocoDao->findAll();
$perfis = $perfilDao->findAll();
date_default_timezone_set('America/Sao_Paulo');
// $dataLocal = date('d/m/Y H:i:s', time());
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Vincular Morador</title>
    <script src="../assets/js/ajax_vincularApartamentoMorador.js"></script>
    
</head>
<body>
    <!-- Início do container -->
    <div class="container-fluid">
        <?php
            include(__DIR__ . "/../administracao/menu.php");
        ?>
    </div>
    <div class="containerMenuDireita">
        <div class="col-md-12 mb-3">
            <?php 
                // echo "<pre>";
                     //var_dump($morador);
                // echo "</pre>";
                if (isset($_SESSION['vinculo_sucesso'])) :?>
                    <div class="col-12" style="background-color: #0e972c; text-align: center; color:white">
                    <?php 
                        echo $_SESSION['vinculo_sucesso'];
                        unset($_SESSION['vinculo_sucesso']);
                endif;
                if (isset($_SESSION['vinculo_erro'])) :?>
                    <div class="col-12" style="background-color: red; text-align: center; color:white">
                    <?php 
                        echo $_SESSION['vinculo_erro'];
                        //echo $_SESSION['cpf_existe'];
                        unset($_SESSION['vinculo_erro']);
                endif;
            ?>
        </div>
        <div class="row" style="margin-top: 5%;">
            <div class="col-md-12 mb-3">
                <fieldset>
                    <legend>Vincular de Moradores</legend>
                    <!-- <form method="post" action="index.php">Form Geral -->
                    <!-- onsubmit="return checaFormulario(this)" -->
                    <form id="form1" name="form1" action="checaCadastroVinculo.php" method="post" onsubmit="return checaFormulario(this)" />
                        <div class="form-row"><!-- Div1 -->
                            <input type="hidden" name="id" value="<?=$morador->getId();?>">                                                    
                            <div class="col-md-10 mb-3"><!-- Nome do Morador -->
                                <label for="nome" class="required">Nome</label>
                                <input type="text" disabled="disabled" class="form-control" id="nome" name="nome" value="<?=$morador->getNome();?>" maxlength="100" placeholder="Informe o nome do morador"required />                    
                            </div>
                            <div class="col-md-2 mb-3"><!-- Nome do Morador -->
                                <label for="cpf" class="required">CPF</label>
                                <input type="hidden" name="cpf" value="<?=$morador->getCpf();?>">                                                    
                                <input type="text" disabled="disabled" class="form-control" id="cpf" name="cpf" value="<?=$morador->getCpf();?>" maxlength="11" placeholder="Somente números" required />                               
                                <?php if (isset($_SESSION['cpf_existe'])) {
                                        echo "<p style='color:red;'>" .$_SESSION['cpf_existe']."</p>";
                                        unset($_SESSION['cpf_existe']);
                                    }?>
                                    
                            </div>                          
                            <div class="col-md-2 mb-3" id="div_blocos"><!-- select Apartamento -->
                                <label for="blocoId" class="required">Bloco</label>
                                <select class="form-control" name="blocoId" onchange="show_vincularApartamentoMorador(this.value)" required />
                                    <!-- <option value="0" selected disabled>--Selecione um bloco--</option>-->
                                    <option value=""></option>
                                    <?php foreach ($blocos as $bloco): ?>                                                    
                                        <option id="<?=$bloco->getId();?>" value="<?=$bloco->getId();?>" <?=($bloco->getId()==$apartamentoRequisitado->getBloco()->getId()) ? "selected": "";?>><?=$bloco->getApelido();?></option> 
                                    <?php endforeach; ?>                                    
                                </select> 
                            </div>  
                            <div class="col-md-2 mb-3" id="div_apartamentos"><!-- select Apartamento -->
                                <label for="apartamentoId" class="required">Apartamento</label>
                                <select class="form-control" name="apartamentoId" required / >
                                    <!-- <option value="0" selected disabled>--Selecione um bloco--</option>-->
                                    <option value="<?=$apartamentoRequisitado->getNome();?>" ><?=$apartamentoRequisitado->getNome();?></option>                      
                                </select> 
                            </div>                                        
                        </div><!-- Fim Div1 -->
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block" name="salvar" value="salvar">Salvar</button>
                        </div><!-- Fim Botões -->
                    </form> <!-- Fim Form Geral -->
                </fieldset>
            </div>
            <div class="col-12">
                <label for="nome" class="required">Pesquisar</label>
                <form action="index.php" method="post">
                    <div class="form-row"><!-- Div1 -->                   
                        <div class="col-md-2 mb-3"><!-- Nome do CPF -->
                            <input type="text" class="form-control" id="pesquisar_cpf" name="pesquisar_cpf" maxlength="11" placeholder="Pesquisar por CPF" />                    
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-secundary btn-block" name="pesquisar" value="pesquisar">Pesquisar</button>
                    </div><!-- Fim Botões -->
                </form>
            </div>
            <div class="col-12"> <!-- Tabela -->
                 <fieldset>
                     <legend>Resultado das pesquisa</legend>
                     <table class="table table-striped table-hover">
                         <thead>
                             <th>ID</th>
                             <th>NOME</th>
                             <th>CPF</th>
                             <th>LOGIN</th>
                             <th>BLOCO</th>
                             <th>APARTAMENTO</th>
                             <th colspan="1">Ações</th>
                         </thead>
                         <tbody>
                             <!-- </?php foreach ($moradores as $morador):?> -->
                                <?php
                                    $apartamentoRequisitado = new Apartamento();
                                    $apartamentoRequisitado = $requisitadoDao->findByApartamentoMorador($morador->getId());
                                    $apartamentoRequisitado->getBloco()->getApelido();
                                ?>
                                <tr>
                                    <td><?=$morador->getId();?></td>
                                    <td><?=$morador->getNome();?></td>
                                    <td><?=$morador->getCpf();?></td>
                                    <td><?=$morador->getLogin();?></td>
                                    <td><?=$apartamentoRequisitado->getBloco()->getApelido();?></td>
                                    <td><?=$apartamentoRequisitado->getNome();?></td>
                                    <td>
                                        <form method="post" action="index.php">
                                            <input type="hidden" name="id" value="<?=$morador->getId();?>">
                                            <button type="submit" class="btn btn-primary" name="editar" value="editar">
                                                <i class="far fa-edit"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                             <!-- </?php endforeach; ?> -->
                         </tbody>
                     </table>
                 </fieldset>
             </div> <!-- Fim Tabela -->
        </div> 
    </div> <!-- Menu Direita -->
    
 </body>
 </html> 