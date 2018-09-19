<?php
require_once(__DIR__ . "/../classes/modelo/User.class.php");
require_once(__DIR__ . "/../classes/modelo/Morador.class.php");
require_once(__DIR__ . "/../classes/dao/MoradorDAO.class.php");

session_start();

$morador = new Morador();
$moradorDao = new MoradorDAO();

$morador = $moradorDao->findByLogin($_POST['login']);
$num = count($morador->getLogin());

echo "<script>alert('Usuario ' + $num +'{$morador->getNome()}.{$morador->getSenha()}')</script>";
if ($num > 0) {
    $_SESSION['MoradorID'] = $morador->getId();
    $_SESSION['MoradorNome'] = $morador->getNome();
    $_SESSION['MoradorPerfilID'] = $morador->getPerfil()->getId();
    $_SESSION['MoradorPerfilNome'] = $morador->getPerfil()->getNome();
        
    $loginDB = $morador->getLogin();
    $senhaDB = $morador->getSenha();
    
    $login = strtoupper($_POST['login']);
    $senha = $_POST['senha'];
    //}
    //$user = new User($login, $senha);

    //$user = new User("admin", "senac");
    //$login = strtoupper($_POST['login']);
    //$senha = $_POST['senha'];

    //if ($user->logar($login, $senha)) {

    if ($loginDB == $login && $senhaDB == $senha)  {
        $_SESSION['isLogado'] = true;
        header('location: /cursoPHP/revisao/assembleia/assembleia/');
    } else {
        $_SESSION['isLogado'] = false;
        $_SESSION['mensagem'] = "Login ou Senha inválidos!!!";
        header('location: /cursoPHP/revisao/assembleia/');
    }

} else {
    $_SESSION['isLogado'] = false;
    $_SESSION['mensagem'] = "Login ou Senha inválidos!!!";
    header('location: /cursoPHP/revisao/assembleia/');
}