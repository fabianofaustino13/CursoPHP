<?php 
session_start();
if ($_SESSION['MoradorStatus'] == NULL || $_SESSION['MoradorStatus'] == 2) {
    header('location: ../assembleia/aguardando.php');
}

include(__DIR__ . "/../administracao/logado.php");

require_once(__DIR__ . "/../classes/modelo/Assembleia.class.php");
require_once(__DIR__ . "/../classes/modelo/TipoAssembleia.class.php");
require_once(__DIR__ . "/../classes/dao/AssembleiaDAO.class.php");
require_once(__DIR__ . "/../classes/dao/TipoAssembleiaDAO.class.php");
 

$assembleia = new Assembleia();
$assembleiaDao = new AssembleiaDAO();

$tipoAssembleia = new TipoAssembleia();
$tipoAssembleiaDao = new TipoAssembleiaDAO();
$tipoAssembleias = $tipoAssembleiaDao->findAll();

if (isset($_POST['editar']) && $_POST['editar'] == 'editar') {
    $assembleia = $assembleiaDao->findById($_POST['id']);
}

if (isset($_POST['excluir']) && $_POST['excluir'] == 'excluir') {
    $assembleiaDao->remove($_POST['id']);
    header('location: index.php');
}
$assembleias = $assembleiaDao->findAll();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Cadastrar Assembléia</title>
</head>
<body>
    <!-- include Menu -->
    <div class="container-fluid">
        <?php
            include(__DIR__ . "/../administracao/menu.php");
        ?>
    <!-- Início do container -->
        <div class="containerMenuDireita">
            <div class="col-md-12 mb-3">
                <?php
                    echo "<pre>";
                        //var_dump($assembleia);
                    echo "</pre>";

                    if (isset($_SESSION['assembleia_sucesso'])) :?>
                    
                        <div class="col-12" style="background-color: #0e972c; text-align: center; color:white">
                        <?php 
                            echo $_SESSION['assembleia_sucesso'];
                            unset($_SESSION['assembleia_sucesso']);
                        endif;
                    if (isset($_SESSION['assembleia_erro'])) :?>
                        <div class="col-12" style="background-color: red; text-align: center; color:white">
                        <?php 
                            echo $_SESSION['assembleia_erro'];
                            //echo $_SESSION['cpf_existe'];
                            unset($_SESSION['assembleia_erro']);
                    endif;
                ?>
            </div>
            <div class="row"  style="margin-top:5%;">
                <div class="col-md-12 mb-3">
                    <legend>Cadastro das Assembléias</legend>
                    <form method="post" action="checaAssembleia.php"><!-- Form -->                    
                        <div class="form-row"><!-- Div1 -->                        
                            <label for="tipoAssembleia" class="required">Tipo de Assembléia</label><br><!-- Tipo de Assembleia -->
                            <div class="col-12">
                                <div class="form-group">
                                    <?php foreach ($tipoAssembleias as $tipoAssembleia): ?>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="<?=$tipoAssembleia->getNome();?>" name="tipoAssembleia" value=<?=$tipoAssembleia->getId();?> <?=$tipoAssembleia->getId() == $assembleia->getTipoAssembleia()->getId() ? 'checked': "";?> class="custom-control-input" <?php if ($tipoAssembleia->getId() == 1):?> checked <?php endif; ?> required/>
                                        <label class="custom-control-label" for="<?=$tipoAssembleia->getNome();?>"><?=$tipoAssembleia->getNome();?></label>
                                    </div>
                                    <?php endforeach; ?>                                    
                                </div>
                                <?php if (isset($_SESSION['tipo_null'])) {
                                    echo "<p style='color:red;'>" .$_SESSION['tipo_null']."</p>";
                                    unset($_SESSION['tipo_null']);
                                }?>
                                <?php if (isset($_SESSION['vazio_tipo'])) {
                                    echo "<p style='color:red;'>" .$_SESSION['vazio_tipo']."</p>";
                                    unset($_SESSION['vazio_tipo']);
                                }?>
                            </div>
                            <div class="col-9"><!-- Nome da assembléia -->
                                <label for="nome" class="required">Nome da Assembléia</label>
                                <input type="hidden" name="id" value="<?=$assembleia->getId();?>">
                            </div>
                            <div class="col-3">
                                <label for="data" class="required">Data da Assembléia</label>
                            </div>
                            <div class="col-md-9 mb-3">
                                <input type="text" class="form-control" id="nome" name="nome" value="<?=$assembleia->getNome();?>" maxlength="100" placeholder="Assembléia Ordinária" />
                                <?php if (isset($_SESSION['vazio_nome'])) {
                                    echo "<p style='color:red;'>" .$_SESSION['vazio_nome']."</p>";
                                    unset($_SESSION['vazio_nome']);
                                }?>
                            </div><!-- Fim da assembléia  -->                         
                            <div class="col-md-3 mb-3"><!-- Data da assembléia -->
                                <input type="date" class="form-control" id="data" name="data" value="<?=$assembleia->getData();?>" />
                                <?php if (isset($_SESSION['data_existe'])) {
                                    echo "<p style='color:red;'>" .$_SESSION['data_existe']."</p>";
                                    unset($_SESSION['data_existe']);
                                }?>
                                <?php if (isset($_SESSION['vazio_data'])) {
                                    echo "<p style='color:red;'>" .$_SESSION['vazio_data']."</p>";
                                    unset($_SESSION['vazio_data']);
                                }?>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block" name="salvar" value="salvar" >Salvar</button>
                            <!-- onclick="return confirmaSalvar();" -->
                        </div><!-- Fim Botões -->
                    </form><!-- Fim Form -->
                </div>
            </div>      

            <div class="col-12"> <!-- Tabela -->
            <fieldset>
                <legend>Lista de Assembléias</legend>
                <table class="table table-striped table-hover">
                    <thead>
                        <th>#</th>
                        <th>Assembleia</th>
                        <th>Data</th>
                        <th>Tipo</th>
                        <th colspan="2">Ações</th>
                    </thead>
                    <tbody>
                        <?php foreach ($assembleias as $assembleia): ?>
                        <tr>
                            <td><?=$assembleia->getId()?></td>
                            <td><?=$assembleia->getNome()?></td>
                            <td><?=$assembleia->getData()?></td>
                            <?php foreach ($tipoAssembleias as $tipoAssembleia):
                                        if ($assembleia->getTipoAssembleia()->getId() == $tipoAssembleia->getId()): ?>
                                            <td><?=$tipoAssembleia->getNome()?></td> 
                                            <?php endif; ?>
                                            <?php endforeach; ?>
                                            <td>
                                                <form method="post" action="index.php">
                                                    <input type="hidden" name="id" value="<?=$assembleia->getId();?>">
                                                    <button type="submit" class="btn btn-primary" name="editar" value="editar">
                                                        <i class="far fa-edit"></i>
                                                    </button>
                                                </form>
                                            </td>
                                            <td>
                                                <form method="post" action="index.php"> 
                                                    <input type="hidden" name="id" value="<?=$assembleia->getId();?>">
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
    </div><!-- Fim do container -->
    <script src="../assets/js/confirma.js"></script>
</body>
</html> 