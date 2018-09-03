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
    $bairro->getCidade()->setId($_POST['cidade']);
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
        $(function(){
    $('#estadoId').change(function(){
        alert(estadoId);
      if( $(this).val() ) {
        $('#estadoId').hide();
        $('.carregando').show();
        $.getJSON(
          'cidades.ajax.php?search=',
          {
            estadoId: $(this).val(),
            ajax: 'true'
          }, function(j){
            var options = '<option value=""></option>';
            for (var i = 0; i < j.length; i++) {
              options += '<option value="' +
                j[i].cidadeId + '">' +
                j[i].nome + '</option>';
            }
            $('#cidadeId').html(options).show();
            $('.carregando').hide();
          });
      } else {
        $('#cidadeId').html(
          '<option value="">-- Escolha um estado --</option>'
        );
      }
    });
  });
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
                            <label for="cidadeId">Cidade</label>
                            <select class="form-control" name="cidadeId" id="cidadeId">
                                <option value="" disabled selected>Selecione uma cidade...</option>
                                <?php foreach($cidades as $cidade): ?>
                                    <option value="<?=$cidade->getId();?>" <?=$cidade->getId() == $bairro->getCidade()->getId() ? "selected": "";?>><?=$cidade->getNome();?></option>  
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <!-- <div>
                            <label for="uf" class="input-label">Estado</label>
                            <select name="uf" id="uf" disabled data-target="#cidade">
                                <option value="">Estado</option>
                            </select>
                        </div>
                        <div>
                            <label for="cidade" class="input-label">Cidade</label>
                            <select name="cidade" id="cidade" disabled>
                                    <option value="">Cidade</option>
                            </select>
                        </div> -->


                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block" name="salvar" value="salvar" onclick="return confirmaSalvar();">Salvar</button>
                        </div>
                    </form>
                </fieldset>
            </div> <!-- Fim Form -->
            <div class="col-md-6 mb-3 "> <!-- Tabela -->
                <fieldset>
                    <legend>Lista dos Bairros das Cidades</legend>
                    <table class="table table-striped table-hover">
                        <thead>
                            <th>#</th>
                            <th>Bairro</th>
                            <th>Cidade</th>
                            <th colspan="2">Ações</th>
                        </thead>
                        <tbody>
                            <?php 
                                foreach ($bairros as $bairro): ?>
                                <tr>
                                    <td><?=$bairro->getId()?></td>
                                    <td><?=$bairro->getNome()?></td>
                                    <td><?php foreach ($cidades as $cidade):?> <?php if ($bairro->getCidade()->getId() == $cidade->getId()):?> <?=$bairro->getCidade()->getNome();?></td> <?php endif; endforeach;?>
                                
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