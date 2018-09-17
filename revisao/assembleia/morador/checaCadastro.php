<?php 
require_once(__DIR__ . "/../classes/modelo/Apartamento.class.php");
require_once(__DIR__ . "/../classes/modelo/bloco.class.php");
require_once(__DIR__ . "/../classes/dao/ApartamentoDAO.class.php");
require_once(__DIR__ . "/../classes/modelo/Morador.class.php");
require_once(__DIR__ . "/../classes/dao/MoradorDAO.class.php");

//  $$bloId = $_GET['blocoId'];
// $bloco = new Bloco();
// $bloco->setId($bloId);

// $apartamentoDao = new ApartamentoDAO();
// $apartamentos = $apartamentoDao->findApartamentoBloco($bloco);

$morNome = $_POST['nome'];
$morCpf = $_POST['cpf'];
$morLogin = $_POST['login'];
$morStatus = $_POST['sindico'];
$morPer = $_POST['perfil'];
$morSenha = $_POST['senha'];

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Checa Cadastro</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
</head>
<body>    
    

</body>
</html>