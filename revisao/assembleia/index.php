<?php 
    
include(__DIR__ . "./administracao/deslogado.php");

$mensagem = "";
if (isset($_SESSION['mensagem'])) {
    $mensagem = $_SESSION['mensagem'];
    session_destroy();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Assembléia</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./assets/css/bootstrap.css">
    <link rel="stylesheet" href="./assets/css/all.css">

</head>
<body>
    <div class="container">
            <div class="row">
                <div class="col-12">
                <fieldset>
                    <legend>Login da Assembléia</legend>
                    <form action="./administracao/login.php" method="post">
                        <div class="col-12" style="text-align: center; color:red">
                            <?=$mensagem;?>
                        </div>
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