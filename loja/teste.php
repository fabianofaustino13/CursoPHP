<!DOCTYPE html>
<html>
<head>
  <title>Bootstrap Example</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Accordion Example</h2>
  <p><strong>Note:</strong> The <strong>data-parent</strong> attribute makes sure that all collapsible elements under the specified parent will be closed when one of the collapsible item is shown.</p>
    <div id="accordion">
        <div class="card">
            <div class="card-header">
                <a>#</a>
                <a>Nome</a>
                <a class="collapsed card-link" data-toggle="collapse" href="#collapseTwo">
                Endereço
                </a>
            </div>
        <div id="collapseTwo" class="collapse" data-parent="#accordion">
            <div class="card-body">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
            </div>
        </div>
    </div>
</div>
    
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>CPF</th>
                                <th>MATRÍCULA</th>
                                <th>SEXO</th>
                                <th>Endereco</th>                                
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
                                        
                                    </td>
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


</body>
</html>
