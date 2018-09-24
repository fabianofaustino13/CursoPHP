<?php 
//Tela de cadastro do Morador - Auto-Cadastro
session_start();
if ($_SESSION['MoradorStatus'] == NULL) {
    header('location: ../assembleia/aguardando.php');
}
$mensagem = "";
if (isset($_SESSION['mensagem'])) {
    $mensagem = $_SESSION['mensagem'];
    session_destroy();
}

require_once(__DIR__ . "/../classes/modelo/Morador.class.php");
require_once(__DIR__ . "/../classes/dao/MoradorDAO.class.php");
require_once(__DIR__ . "/../classes/modelo/Perfil.class.php");
require_once(__DIR__ . "/../classes/dao/PerfilDAO.class.php");

$perfil = new Perfil();
$perfilDao = new PerfilDAO();

$morador = new Morador();
$moradorDao = new MoradorDAO();

date_default_timezone_set('America/Sao_Paulo');

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Cadastro do Morador</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/home2.css">
    <link rel="stylesheet" href="../assets/css/all.css">
    <style type="text/css">
        * { margin: 0; padding: 0; font-family:Tahoma; font-size:9pt;}
        #divCenter { 
                background-color: #e1e1e1; 
                width: 80%; 
                height: 300px; 
                left: 10%; 
                /* margin: -130px 0 0 -210px;  */
                padding:10px;
                position: absolute; 
                top: 10%; }
    </style>
</head>
<body>
    <div id="divCenter">
        <div class="col-md-12 mb-3">
            <?php if (isset($_SESSION['morador_sucesso'])) :?>                
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
                    endif;?>
                </div>
            <div class="row" style="margin-top: 5%;">
                <div class="col-md-12 mb-3">
                    <!-- onsubmit="return checaFormulario()"  -->
                    <fieldset>
                        <legend>Cadastro do Morador</legend>
                        <!-- <form method="post" action="index.php">Form Geral -->
                        <!-- onsubmit="return checaFormulario(this)" -->
                        <form id="form1" name="form1" action="checaCadastro.php" method="post" onsubmit="return checaFormulario(this)" />
                            <div class="form-row"><!-- Div1 -->
                                <input type="hidden" name="id" value="<?=$morador->getId();?>">                                                    
                                <div class="col-md-10 mb-3"><!-- Nome do Morador -->
                                    <label for="nome" class="required">Nome</label>
                                    <input type="text" class="form-control" id="nome" name="nome" value="<?=$morador->getNome();?>" maxlength="100" placeholder="Informe o nome do morador"required />                    
                                </div>
                                <div class="col-md-2 mb-3"><!-- Nome do Morador -->
                                    <label for="cpf" class="required">CPF</label>
                                    <input type="text" class="form-control" id="cpf" name="cpf" value="<?=$morador->getCpf();?>" maxlength="11" placeholder="Somente números" required />                               
                                    <?php if (isset($_SESSION['cpf_existe'])) {
                                        echo "<p style='color:red;'>" .$_SESSION['cpf_existe']."</p>";
                                        unset($_SESSION['cpf_existe']);
                                    }?>      
                                </div>                        
                                <div class="col-md-3 mb-3">
                                    <label for="login" class="required">Login</label>
                                    <input type="text" class="form-control" id="login" name="login" value="<?=$morador->getLogin();?>" maxlength="25" placeholder="Login do morador" required />
                                    <?php if (isset($_SESSION['login_existe'])) {
                                        echo "<p style='color:red;'>" .$_SESSION['login_existe']."</p>";
                                        unset($_SESSION['login_existe']);
                                    }?>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label for="senha" class="required">Senha</label>
                                    <input type="password" class="form-control" id="senha" name="senha"  maxlength="25" placeholder="Digite uma senha" required />
                                    <!-- value="</?=$apartamento->getMorador()->getSenha();?>" -->
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label for="senha2">Confirme a Senha</label>
                                    <input type="password" class="form-control" id="senha2" name="senha2"  maxlength="25" placeholder="Confirme a senha" required />
                                    <!-- value="<//?=$apartamento->getMorador()->getSenha();?>" -->
                                </div>
                            </div><!-- Fim Div1 -->
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block" name="salvar" value="salvar">Salvar</button>
                            </div><!-- Fim Botões -->
                        </form> <!-- Fim Form Geral -->
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
    <script src="../assets/js/ajax_funcoes.js"></script>
 </body>
 </html> 