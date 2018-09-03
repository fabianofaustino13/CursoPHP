<?php
require_once(__DIR__ . "/../classes/modelo/User.class.php");

session_start();

$user = new User("admin", "senac");
$login = $_POST['login'];
$senha = $_POST['senha'];

if ($user->logar($login, $senha)) {
    $_SESSION['isLogado'] = true;
    header('location: /cursoPHP/revisao/assembleia/assembleia/');
} else {
    $_SESSION['isLogado'] = false;
    $_SESSION['mensagem'] = "Login ou Senha inválidos!!!";
    header('location: /cursoPHP/revisao/assembleia/');
}