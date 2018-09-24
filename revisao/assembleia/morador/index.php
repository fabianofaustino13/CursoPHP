<?php 
session_start();
if ($_SESSION['MoradorStatus'] == NULL) {
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

$perfil = new Perfil();
$perfilDao = new PerfilDAO();

$bloco = new Bloco();
$blocoDao = new BlocoDAO();

$apartamento = new Apartamento();
$apartamentoDao = new ApartamentoDAO();

$morador = new Morador();
$moradorDao = new MoradorDAO();

if (isset($_POST['editar']) && $_POST['editar'] == 'editar') {
    $apartamento = $apartamentoDao->findByMoradorApartamento($_POST['id']);
    // $apartamento = $apartamentoDao->findByMorador($_POST['id']);
}

if (isset($_POST['excluir']) && $_POST['excluir'] == 'excluir') {
    $morador = $moradorDao->findByApartamento($_POST['id']);
    header('location: index.php');
}

//$cpf = $moradorDao->findCpf('11111111111');
$moradores = $moradorDao->findAll();
$apartamentos = $apartamentoDao->findAll();
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
            <div class="col-12" style="text-align: center; color:red">
                <!-- <//?=var_dump($teste);?> -->
            </div>
        </div>
        <div class="row" style="margin-top: 5%;">
            <!-- onsubmit="return checaFormulario()"  -->
                <fieldset>
                    <legend>Cadastro de Moradores</legend>
                    <!-- <form method="post" action="index.php">Form Geral -->
                    <!-- onsubmit="return checaFormulario(this)" -->
                    <form id="form1" name="form1" action="checaCadastroMorador.php" method="post" onsubmit="return checaFormulario(this)" />
                        <div class="form-row"><!-- Div1 -->
                            <input type="hidden" name="id" value="<?=$apartamento->getMorador()->getId();?>">                                                    
                            <div class="col-md-10 mb-3"><!-- Nome do Morador -->
                                <label for="nome" class="required">Nome</label>
                                <input type="text" class="form-control" id="nome" name="nome" value="<?=$apartamento->getMorador()->getNome();?>" maxlength="100" placeholder="Informe o nome do morador"required />                    
                            </div>
                            <div class="col-md-2 mb-3"><!-- Nome do Morador -->
                                <label for="cpf" class="required">CPF</label>
                                <input type="text" class="form-control" id="cpf" name="cpf" value="<?=$apartamento->getMorador()->getCpf();?>" maxlength="11" placeholder="Somente números" required />                               
                                <?php if (isset($_SESSION['cpf_existe'])) {
                                        echo "<p style='color:red;'>" .$_SESSION['cpf_existe']."</p>";
                                        unset($_SESSION['cpf_existe']);
                                    }?>
                                    
                            </div>                        
                            <div class="col-md-3 mb-3">
                                <label for="login" class="required">Login</label>
                                <input type="text" class="form-control" id="login" name="login" value="<?=$apartamento->getMorador()->getLogin();?>" maxlength="25" placeholder="Login do morador" required />
                                <?php if (isset($_SESSION['login_existe'])) {
                                    echo "<p style='color:red;'>" .$_SESSION['login_existe']."</p>";
                                    unset($_SESSION['login_existe']);
                                }?>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label for="senha" class="required">Senha</label>
                                <input type="password" class="form-control" id="senha" name="senha"  maxlength="25" placeholder="Digite uma senha"  />
                                <!-- value="</?=$apartamento->getMorador()->getSenha();?>" -->
                            </div>
                            <div class="col-md-2 mb-3">
                                <label for="senha2">Confirme a Senha</label>
                                <input type="password" class="form-control" id="senha2" name="senha2"  maxlength="25" placeholder="Confirme a senha"  />
                                <!-- value="<//?=$apartamento->getMorador()->getSenha();?>" -->
                            </div>                                  
                            <div class="col-md-3 mb-3"><!-- select Perfil -->
                                <label for="perfil" class="required">Perfil</label>
                                <select class="form-control" name="perfil" required/>
                                    <!-- <option value="4" selected disabled>--SELECIONE--</option> -->
                                    <?php foreach ($perfis as $perfil): ?>                                                    
                                        <option id="<?=$perfil->getId();?>" value="<?=$perfil->getId();?>"><?=$perfil->getNome();?></option> 
                                    <?php endforeach; ?>                                    
                                </select> 
                            </div>  
                            <div class="col-md-2 mb-3"><!-- select Perfil -->
                                <label for="status" class="required">Situação</label>
                                <select class="form-control" name="status" required/>
                                    <option value="1" selected>ATIVO</option>                                                
                                    <option value="0">INATIVO</option>                                                
                                </select> 
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
                             <th>ID</th>
                             <th>Nome</th>
                             <th>CPF</th>
                             <th>LOGIN</th>
                             <th>Bloco</th>
                             <th>Apartamento</th>
                             <th colspan="3" style="text-align:center;">Ações</th>
                         </thead>
                         <tbody>
                             <?php foreach ($apartamentos as $apartamento):?>
                                 <tr>
                                     <td><?=$apartamento->getMorador()->getId()?></td>
                                     <td><?=$apartamento->getMorador()->getNome()?></td>
                                     <td><?=$apartamento->getMorador()->getCpf()?></td>
                                     <td><?=$apartamento->getMorador()->getLogin()?></td>
                                     <td><?=$apartamento->getBloco()->getApelido()?></td>
                                     <td><?=$apartamento->getNome()?></td>
                                     <td>
                                         <form method="post" action="index.php">
                                             <input type="hidden" name="id" value="<?=$apartamento->getMorador()->getId();?>">
                                             <button type="submit" class="btn btn-primary" name="editar" value="editar">
                                                 <i class="far fa-edit"></i>
                                             </button>
                                         </form>
                                     </td>
                                     <td>
                                        <a href="gerenciarMorador.php" class="btn btn btn-success btn-md" tabindex="-1" role="button" aria-disabled="true"><i class="fab fa-gg"></i></a>
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