<?php 
    include(__DIR__ . "/./deslogado.php");
  
    $mensagem = "";
    if (isset($_SESSION['mensagem'])) {
        $mensagem = $_SESSION['mensagem'];
        session_destroy();
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Loja</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <link rel="stylesheet" href="./assets/css/loja.css">
    <link rel="stylesheet" href="./assets/css/all.css">
    <link rel="stylesheet" href="./assets/css/bootstrap.css">

</head>
<body>
  
    <div class="container">
        <div class="row">
            <?=$mensagem;?>
        </div>
        <div class="row">
            <div class="col-12">
            <fieldset>
                <legend>Login da Loja</legend>
                <form action="login.php" method="post">
                    <div class="form-group">
                        <label for="login">Login</label>
                        <input type="text" class="form-control" name="login" id="login">
                    </div>
                    <div class="form-group">
                        <label for="senha">Senha</label>
                        <input type="password" class="form-control" name="senha" id="senha">
                    </div>
                    <div class="form-group"> <!-- Botão -->
                        <button type="submit" class="btn btn-primary btn-block" name="salvar" value="salvar" onclick="return confirmaSalvar();">
                            <i class="fas fa-save"></i> Salvar
                        </button>
                    </div>

                </form>

            </fieldset>
            </div>
        
        </div>
    </div>

</body>
</html>