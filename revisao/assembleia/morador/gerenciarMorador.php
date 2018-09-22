<?php 
session_start();

include(__DIR__ . "/../administracao/logado.php");

require_once(__DIR__ . "/../classes/modelo/Morador.class.php");
require_once(__DIR__ . "/../classes/dao/MoradorDAO.class.php");
require_once(__DIR__ . "/../classes/modelo/Perfil.class.php");
require_once(__DIR__ . "/../classes/dao/PerfilDAO.class.php");

$perfil = new Perfil();
$perfilDao = new PerfilDAO();

$morador = new Morador();
$moradorDao = new MoradorDAO();

if (isset($_POST['editar']) && $_POST['editar'] == 'editar') {
    $morador = $moradorDao->findById($_POST['id']);
    // $apartamento = $apartamentoDao->findByMorador($_POST['id']);
}

if (isset($_POST['excluir']) && $_POST['excluir'] == 'excluir') {
    $morador = $moradorDao->findById($_POST['id']);
    header('location: index.php');
}

//$cpf = $moradorDao->findCpf('11111111111');
$moradores = $moradorDao->findAll();
$perfis = $perfilDao->findAll();
date_default_timezone_set('America/Sao_Paulo');
// $dataLocal = date('d/m/Y H:i:s', time());
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Gerencia Morador</title>
    
</head>
<body>
    <!-- Início do container -->
    <div class="container-fluid">
    <!-- include Menu -->
    <?php
        include(__DIR__ . "/../administracao/menu.php");
    ?>
    </div>
    <div class="containerMenuDireita">
        <div class="col-md-12 mb-3">
            <?php 
            // echo $aviso;
                // echo "<pre>";
                
                     //var_dump($morador);
                
                // echo "</pre>";
                if (isset($_SESSION['morador_sucesso'])) :?>
                
                    <div class="col-12" style="background-color: #0e972c; text-align: center; color:white">
                    <?php 
                        echo $_SESSION['morador_sucesso'];
                        unset($_SESSION['morador_sucesso']);
                endif;
                if (isset($_SESSION['morador_erro'])) :?>
                    <div class="col-12" style="background-color: red; text-align: center; color:white">
                    <?php 
                        echo $_SESSION['morador_erro'];
                        //echo $_SESSION['cpf_existe'];
                        unset($_SESSION['morador_erro']);
                endif;
            ?>
        </div>
        <div class="row" style="margin-top: 5%;">
            <div class="col-md-12 mb-3">
                <!-- onsubmit="return checaFormulario()"  -->
                <fieldset>
                    <legend>Gerenciar Moradores</legend>
                    <!-- <form method="post" action="index.php">Form Geral -->
                    <!-- onsubmit="return checaFormulario(this)" -->
                    <form id="form1" name="form1" action="checaGerenciaMorador.php" method="post" onsubmit="return checaFormulario(this)" />
                        <div class="form-row"><!-- Div1 -->
                            <input type="hidden" name="id" value="<?=$morador->getId();?>">                                                    
                            <div class="col-md-10 mb-3"><!-- Nome do Morador -->
                                <label for="nome" class="required">Nome</label>
                                <input type="text" disabled="disabled" class="form-control" id="nome" name="nome" value="<?=$morador->getNome();?>" maxlength="100" placeholder="Informe o nome do morador"required />                    
                            </div>
                            <div class="col-md-2 mb-3"><!-- Nome do Morador -->
                                <label for="cpf" class="required">CPF</label>
                                <input type="text" disabled="disabled" class="form-control" id="cpf" name="cpf" value="<?=$morador->getCpf();?>" maxlength="11" placeholder="Somente números" required />                               
                                <?php if (isset($_SESSION['cpf_existe'])) {
                                        echo "<p style='color:red;'>" .$_SESSION['cpf_existe']."</p>";
                                        unset($_SESSION['cpf_existe']);
                                    }?>
                                    
                            </div>                        
                            <div class="col-md-3 mb-3">
                                <label for="login" class="required">Login</label>
                                <input type="text" disabled="disabled" class="form-control" id="login" name="login" value="<?=$morador->getLogin();?>" maxlength="25" placeholder="Login do morador" required />
                                <?php if (isset($_SESSION['login_existe'])) {
                                    echo "<p style='color:red;'>" .$_SESSION['login_existe']."</p>";
                                    unset($_SESSION['login_existe']);
                                }?>
                            </div>
                            <div class="col-md-3 mb-3"><!-- select Perfil -->
                                <label for="perfil" class="required">Perfil</label>
                                <select class="form-control" name="perfil" required/>
                                    <!-- <option value="4" selected disabled>--SELECIONE--</option> -->
                                    <?php foreach ($perfis as $perfil): ?>                                                    
                                        <option id="<?=$perfil->getId();?>" value="<?=$perfil->getId();?>" <?=($perfil->getId() == $morador->getPerfil()->getId() ? "selected":" ") ?>><?=$perfil->getNome();?></option> 
                                    <?php endforeach; ?>                                    
                                </select> 
                            </div>  
                            <div class="col-md-2 mb-3"><!-- select Perfil -->
                                <label for="status" class="required">Situação</label>
                                <select class="form-control" name="status" required/>
                                    <option value="1">ATIVO</option>  
                                    <option value="2">INATIVO</option>                                                
                                </select> 
                            </div>                             
                        </div><!-- Fim Div1 -->
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block" name="salvar" value="salvar">Salvar</button>
                        </div><!-- Fim Botões -->
                    </form> <!-- Fim Form Geral -->
                </fieldset>
            </div>
        </div>
        <div class="col-12"> <!-- Tabela -->
            <fieldset>
                <legend>Lista dos Moradores</legend>
                <table class="table table-striped table-hover">
                    <thead>
                        <th>ID</th>
                        <th>NOME</th>
                        <th>CPF</th>
                        <th>LOGIN</th>
                        <th>PERFIL</th>
                        <th>STATUS</th>
                        <th colspan="2">Ações</th>
                    </thead>
                    <tbody>
                        <?php foreach ($moradores as $morador):?>
                            <tr>
                                <td><?=$morador->getId();?></td>
                                <td><?=$morador->getNome();?></td>
                                <td><?=$morador->getCpf();?></td>
                                <td><?=$morador->getLogin();?></td>
                                <td><?=$morador->getPerfil()->getNome();?></td>
                                <td><?=($morador->getStatus() == 1) ? "ATIVO":"INATIVO";?></td>
                                <td>
                                    <form method="post" action="gerenciarMorador.php">
                                        <input type="hidden" name="id" value="<?=$morador->getId();?>">
                                        <button type="submit" class="btn btn-primary" name="editar" value="editar">
                                            <i class="far fa-edit"></i>
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <form method="post" action="gerenciarMorador.php"> 
                                        <input type="hidden" name="id" value="<?=$morador->getId();?>">
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
     </div> <!-- Fim do container -->
     <script src="../assets/js/ajax_funcoes.js"></script>
 </body>
 </html> 