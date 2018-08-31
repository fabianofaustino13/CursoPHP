<?php require_once(__DIR__ . "/../classes/modelo/Estado.class.php"); ?>
<?php require_once(__DIR__ . "/../classes/dao/EstadoDAO.class.php"); ?>
<?php require_once(__DIR__ . "/../classes/modelo/Cidade.class.php"); ?>
<?php require_once(__DIR__ . "/../classes/dao/CidadeDAO.class.php"); ?>
<?php require_once(__DIR__ . "/../classes/modelo/Bairro.class.php"); ?>
<?php require_once(__DIR__ . "/../classes/dao/BairroDAO.class.php"); ?>
<?php 
include(__DIR__ . "/../administracao/logado.php");

$estado = new Estado();
$estadoDao = new EstadoDAO();
$cidade = new Cidade();
$cidadeDao = new CidadeDAO();
$bairro = new Bairro();
$bairroDao = new BairroDAO();

if (isset($_POST['salvar']) && $_POST['salvar'] == 'salvar') {
    $bairro->setNome($_POST['nome']);
    $bairro->getCidade()->setId($_POST['cidadeId']);
    if ($_POST['id'] != '') {
        $bairro->setId($_POST['id']);
    }
    $bairroDao->save($bairro);
    header('location: index.php');
} 

if (isset($_POST['editar']) && $_POST['editar'] == 'editar') {
    $bairro = $bairroDao->findById($_POST['id']);
}

if (isset($_POST['excluir']) && $_POST['excluir'] == 'excluir') {
    $bairroDao->remove($_POST['id']);
    header('location: index.php');
}
$cidades = $cidadeDao->findAll();
$estados = $estadoDao->findAll();
$bairros = $bairroDao->findAll();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Bairros</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script>
        function estado(estadoId) { 
            
            if (estadoId=="") {
                document.getElementById("cidadeId").innerHTML="";
                return;
            } 
            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp=new XMLHttpRequest();
            } else { // code for IE6, IE5
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function() {
                if (this.readyState==4 && this.status==200) {
                document.getElementById("cidadeId").innerHTML=this.responseText;
                }
            }
            xmlhttp.open("GET","getuser.php?q="+estadoId,true);
            xmlhttp.send();
        }
    </script>
</head>
<body>
    <!-- Include Menu -->
    <?php
        include(__DIR__ . "/../administracao/menu.php");
    ?> 
    
    <div class="container">
        <div class="row" style="margin: 5%;">
            <div class="col-md-6 mb-3"> <!-- Form -->
                <fieldset>
                    <legend>Dados do Bairro</legend>
                    <form action="index.php" method="post" id="form-salvar">
                        <div class="form-group">
                            <input type="hidden" name="id" value="<?=$bairro->getId();?>">
                            <label for="nome" class="required">Bairro</label>
                            <input type="text" class="form-control" name="nome" id="nome" maxlength="25" required value="<?=$bairro->getNome();?>">
                        </div>
                        <div class="form-group"> <!-- input Marca -->
                            <label for="estadoId">Estado</label>
                            <select class="form-control" name="estadoId" id="estadoId" onchange="estado(this.value)">
                                <option value="0" disabled selected>Selecione um estado...</option>
                                <?php foreach($estados as $estado): ?>
                                    <option value="<?=$estado->getId();?>" <?=$estado->getId() == $cidade->getEstado()->getId() ? "selected": "";?>><?=$estado->getNome() ." - ". $estado->getSigla();?></option>  
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group" id="cidadeId"> <!-- input Marca -->
                           
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block" name="salvar" value="salvar" onclick="return confirmaSalvar();">Salvar</button>
                        </div>
                    </form>
                </fieldset>
            </div> <!-- Fim Form -->
            <div class="col-md-6 mb-3 "> <!-- Tabela -->
                <fieldset>
                    <legend>Lista das Cidades</legend>
                    <table class="table table-striped table-hover">
                        <thead>
                            <th>#</th>
                            <th>Cidade</th>
                            <th>Estado</th>
                            <th>Sigla</th>
                            <th colspan="2">Ações</th>
                        </thead>
                        <tbody>
                            <?php foreach ($cidades as $cidade): ?>
                                <tr>
                                    <td><?=$cidade->getId()?></td>
                                    <td><?=$cidade->getNome()?></td>
                                    <td><?=$cidade->getEstado()->getNome()?></td>
                                    <td><?=$cidade->getEstado()->getSigla()?></td>
                                    <td>
                                        <form action="index.php" method="post" >
                                            <input type="hidden" name="id" value="<?=$cidade->getId();?>">
                                            <button type="submit" class="btn btn-sm btn-success" name="editar" value="editar"><i class="fas fa-edit"></i></button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="index.php" method="post">
                                            <input type="hidden" name="id" value="<?=$cidade->getId();?>">
                                            <button type="submit" class="btn btn-sm btn-danger" name="excluir" value="excluir"><i class="fas fa-trash-alt"></i></button>
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
    <script src="../assets/js/produto.js"></script>
</body>
</html>