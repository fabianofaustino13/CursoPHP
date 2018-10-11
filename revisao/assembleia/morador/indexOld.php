<?php 
session_start();
if ($_SESSION['MoradorSituacao'] == NULL || $_SESSION['MoradorSituacao'] == 2) {
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
require_once(__DIR__ . "/../classes/modelo/Situacao.class.php");
require_once(__DIR__ . "/../classes/dao/SituacaoDAO.class.php");
require_once(__DIR__ . "/../classes/dao/MoradorRequisitadoDAO.class.php");
require_once(__DIR__ . "/../classes/modelo/Requisitado.class.php");

$perfil = new Perfil();
$perfilDao = new PerfilDAO();

$situacao = new Situacao();
$situacaoDao = new SituacaoDAO();

$bloco = new Bloco();
$blocoDao = new BlocoDAO();

$apartamento = new Apartamento();
$apartamentoDao = new ApartamentoDAO();

$morador = new Morador();
$moradorDao = new MoradorDAO();

$apartamentoRequisitado = new Apartamento();
$moradorRequisitado = new Morador();
$requisitado = new Requisitado();
$moradorRequisitadoDao = new MoradorRequisitadoDAO();


if (isset($_POST['editar']) && $_POST['editar'] == 'editar') {
    //$morador = $moradorDao->findById($_POST['id']);
    $requisitado = $moradorRequisitadoDao->findRequisitadoById($_POST['id']);
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
$situacoes = $situacaoDao->findAll();
$perfis = $perfilDao->findAll();
$requisitados = $moradorRequisitadoDao->findAllRequisitados();
date_default_timezone_set('America/Sao_Paulo');
// $dataLocal = date('d/m/Y H:i:s', time());
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Editar dados dos Moradores</title>
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
        <div class="row" style="margin-top: 2%;">
            <div class="col-md-12 mb-3">
            <!-- onsubmit="return checaFormulario()"  -->
                <?php 
                    echo "<pre>";
                    //var_dump($requisitado);
                    echo "</pre>";
                ?>
                <fieldset>
                    <legend>Editar dados dos Moradores Old</legend>
                    <!-- <form method="post" action="index.php">Form Geral -->
                    <!-- onsubmit="return checaFormulario(this)" -->
                    <form id="form1" name="form1" action="checaCadastroMoradorOld.php" method="post" onsubmit="return checaFormulario(this)" />
                        <div class="form-row"><!-- Div1 -->
                            <input type="hidden" name="id" value="<?=$requisitado->getMorador()->getId();?>">                                                    
                            <div class="col-md-10 mb-3"><!-- Nome do Morador -->
                                <label for="nome" class="required">Nome</label>
                                <input type="text" class="form-control" id="nome" name="nome" value="<?=$requisitado->getMorador()->getNome();?>" maxlength="100" placeholder="Informe o nome do morador"required />                    
                            </div>
                            <div class="col-md-2 mb-3"><!-- Nome do Morador -->
                                <label for="cpf" class="required">CPF</label>
                                <input type="text" class="form-control" id="cpf" name="cpf" value="<?=$requisitado->getMorador()->getCpf();?>" maxlength="11" placeholder="Somente números" required />                               
                                <?php if (isset($_SESSION['cpf_existe'])) {
                                    echo "<p style='color:red;'>" .$_SESSION['cpf_existe']."</p>";
                                    unset($_SESSION['cpf_existe']);
                                }?> 
                            </div>        
                            <div class="col-md-2 mb-3"><!-- select Perfil -->
                                <label for="perfil" class="required">Perfil</label>
                                <select class="form-control" name="perfil" required/>
                                    <!-- <option value="4" selected disabled>--SELECIONE--</option> -->
                                    <?php foreach ($perfis as $perfil): ?>                                                    
                                        <option id="<?=$perfil->getId();?>" value="<?=$perfil->getId();?>" <?=($perfil->getId()==$requisitado->getMorador()->getPerfil()->getId()) ? "selected":"";?> > <?=$perfil->getNome();?></option> 
                                    <?php endforeach; ?>                                    
                                </select> 
                            </div>  
                            <div class="col-md-1 mb-3"><!-- select Perfil -->
                                <label for="situacao" class="required">Situação</label>
                                <select class="form-control" name="situacao" required/>
                                    <?php foreach ($situacoes as $situacao): ?> 
                                        <option id="<?=$situacao->getId()?>" value="<?=$situacao->getId()?>" <?=($situacao->getId()==$requisitado->getMorador()->getSituacao()->getId()) ? "selected":""?>><?=$situacao->getNome();?></option>
                                    <?php endforeach; ?>   
                                </select> 
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="login" class="required">Login</label>
                                <input type="text" class="form-control" id="login" name="login" value="<?=$requisitado->getMorador()->getLogin();?>" maxlength="25" placeholder="Login do morador" required />
                                <?php if (isset($_SESSION['login_existe'])) {
                                    echo "<p style='color:red;'>" .$_SESSION['login_existe']."</p>";
                                    unset($_SESSION['login_existe']);
                                }?>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="senha" class="required">Senha</label>
                                <input type="button" class="btn btn-default btn-block" value="ALTERAR SENHA" <?=($requisitado->getMorador()->getId() == '') ? "disabled":"" ;?> data-toggle="modal" data-target="#alterarSenhaModal" />
                            </div>
                            <!-- <div class="col-md-2 mb-3" id="div_blocos"><!-- select Apartamento -->
                                <!-- <label for="blocoId" class="required">Bloco</label>
                                <select class="form-control" name="blocoId" onchange="show_apartamentosRequisitados(this.value);" required />
                                    <option value="0" selected disabled>--Selecione um bloco--</option>
                                    <option value=""></option> -->
                                    <!-- </?php foreach ($blocos as $bloco): ?>                                                     -->
                                        <!-- <option id="</?=$bloco->getId();?>" value="</?=$bloco->getId();?>" </?=($bloco->getId()==$requisitado->getApartamento()->getBloco()->getId()) ? "selected": "";?>></?=$bloco->getApelido();?></option>  -->
                                    <!-- </?php endforeach; ?>                                     -->
                                <!-- </select>  -->
                            <!-- </div>  -->
                            <!-- <div class="col-md-2 mb-3" id="div_apartamentos">select Apartamento -->
                                <!-- <label for="apartamentoId" class="required">Apartamento</label> -->
                                <!-- <select class="form-control" name="apartamentoId" required/ > -->
                                    <!-- <option value="0" selected disabled>--Selecione um bloco--</option>-->
                                    <!-- <option value="</?=$requisitado->getApartamento()->getId();?>" ></?=$requisitado->getApartamento()->getNome();?></option>                       -->
                                <!-- </select>  -->
                            <!-- </div> -->
                            <div class="col-md-1 mb-3" id="div_blocos"><!-- select Apartamento -->
                                <label for="apartamentoId" class="required">Bloco</label>
                                <input disabled="disabled" type="text" class="form-control" id="blocoId" name="blocoId" value="<?=$requisitado->getApartamento()->getBloco()->getApelido();?>" />
                            </div>
                            <div class="col-md-1 mb-3" id="div_apartamentos"><!-- select Apartamento -->
                                <label for="apartamentoId" class="required">Apartamento</label>
                                <input disabled="disabled" type="text" class="form-control" id="apartamentoId" name="apartamentoId" value="<?=$requisitado->getApartamento()->getNome();?>" />
                            </div>

                        </div><!-- Fim Div1 -->
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-10 mb-3">
                                    <button type="submit" class="btn btn-primary btn-block" name="salvar" value="salvar">Salvar</button>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <button type="submit" class="btn btn-warning btn-block" name="limpar" value="limpar">Limpar</button>
                                </div>
                            </div><!-- Fim Botões -->
                        </div>
                    </form> <!-- Fim Form Geral -->
                </fieldset>
            </div>
            <!-- Mordal Alterar Senha -->
            <div class="modal fade" id="alterarSenhaModal">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h5 class="modal-title">Alterar a senha</h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        
                        <!-- Modal body -->
                        <form name="formModal" method="post" action="checaCadastroMorador.php"> 
                            <div class="modal-body">
                                <input type="hidden" name="id" value="<?=$morador->getId();?>">
                                <div class="col-md-12 mb-3">
                                    <label for="senha" class="required">Senha</label>
                                    <input type="password" class="form-control" id="senha" name="senha" onkeyup="checarSenha()" maxlength="25" placeholder="Digite uma senha"  />    
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="senha2" class="required">Confirme a Senha</label>
                                    <input type="password" class="form-control" id="senha2" name="senha2" onkeyup="checarSenha()" maxlength="25" placeholder="Confirme a senha"  />
                                </div> 
                                <div class="col-md-12 mb-3">
                                    <div id="divcheck">

                                    </div>
                                </div> 
                            </div>
                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-success" id="alterarSenha" name="alterarSenha" value="alterarSenha" disabled>Salvar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12"> <!-- Tabela -->
                <fieldset>
                    <legend>Lista dos Requisitados</legend>
                    <table class="table table-striped table-hover">
                        <thead>
                            <th>ID</th>
                            <th>NOME</th>
                            <th>CPF</th>
                            <th>LOGIN</th>
                            <th>PERFIL</th>
                            <th>SITUAÇÃO</th>                     
                            <th>BLOCO</th>
                            <th>APARTAMENTO</th>  
                            <th>OCUPAÇÃO</th>  
                            <th colspan="2" style="text-align:center;">Ações</th>
                        </thead>
                        <tbody>
                            <?php foreach ($requisitados as $requisitado):?>
                                <tr>
                                    <td><?=$requisitado->getId();?></td>
                                    <td><?=$requisitado->getMorador()->getNome();?></td>
                                    <td><?=$requisitado->getMorador()->getCpf();?></td>
                                    <td><?=$requisitado->getMorador()->getLogin();?></td>
                                    <td><?=$requisitado->getMorador()->getPerfil()->getNome();?></td>
                                    <td><?=$requisitado->getMorador()->getSituacao()->getNome();?></td>                           
                                    <td><?=$requisitado->getApartamento()->getBloco()->getApelido();?></td>
                                    <td><?=$requisitado->getApartamento()->getNome();?></td>
                                    <td><?=$requisitado->getApartamento()->getOcupacao()->getNome();?></td>
                                    <td>
                                        <form method="post" action="indexOld.php">
                                            <input type="hidden" name="id" value="<?=$requisitado->getId();?>">
                                            <button type="submit" class="btn btn-primary" name="editar" value="editar">
                                                <i class="far fa-edit"></i>
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
    </div> <!-- Fim do container -->
    <script>
        $(document).ready(function() {
            $("#senha").keyup(checkPasswordMatch);
            $("#senha2").keyup(checkPasswordMatch);
        });
        function checarSenha() {
            var id = $("#id").val();
            var password = $("#senha").val();
            var password2 = $("#senha2").val();
           
            if (id == '') {
                $("#divcheck").html("<span style='color:red'>Selecione um morador!</span>");
                document.getElementById("alterarSenha").disabled=true;
            }
            if (password == '') {
                $("#divcheck").html("<span style='color:red'>Campo vazio!</span>");
                document.getElementById("alterarSenha").disabled=true;
                //formModal.senha.focus();
            } else if ('' == password2) {
                $("#divcheck").html("<span style='color:red'>Campo vazio!</span>");
                document.getElementById("alterarSenha").disabled=true;
                //formModal.senha2.focus();
            } else if (password != password2) {
                $("#divcheck").html("<span style='color:blue'>Senhas não conferem!</span>");
                document.getElementById("alterarSenha").disabled=true;
            } else {
                $("#divcheck").html("<span style='color:white'></span>");
                document.getElementById("alterarSenha").disabled=false;
            }
        }
    </script>
    <script src="../assets/js/ajax_funcoes.js"></script>
    <script src="../assets/js/jquery.js"></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.js"></script>
 </body>
 </html> 