<?php
session_start();
if ($_SESSION['MoradorStatus'] == NULL || $_SESSION['MoradorStatus'] == 2) {
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
require_once(__DIR__ . "/../classes/modelo/Sindico.class.php");

$perfil = new Perfil();
$perfilDao = new PerfilDAO();

$bloco = new Bloco();
$blocoDao = new BlocoDAO();

$apartamento = new Apartamento();
$apartamentoDao = new ApartamentoDAO();

$morador = new Morador();
$mor = new Morador();
$moradorDao = new MoradorDAO();
$cpf = new Morador();

$continua = true;

if ((isset($_POST['limpar']) && $_POST['limpar'] == 'limpar')) {
    header('location: index.php');
}
if (empty($_POST['nome']) && isset($_POST['nome'])) {
    $_SESSION['vazio_nome'] = "O nome é obrigatório";
    $continua = false;
    header('location: index.php');
} else {
    //$_SESSION['value_nome'] = $_POST['nome'];
}
if (empty($_POST['cpf']) &&  isset($_POST['cpf'])) {
    $_SESSION['vazio_cpf'] = "CPF é obrigatório";
    $cpf = $moradorDao->findCpf($_POST['cpf']);
    //$num = count($cpf->getCpf());
    if ($cpf == 1) {
        //$_SESSION['cpf_existe'] = 'existe';
        header('location: index.php');
    }
    $continua = false;
    header('location: index.php');
} else {
    //$_SESSION['value_cpf'] = $_POST['cpf'];
}

if (empty($_POST['login']) && isset($_POST['login'])) {
    $_SESSION['vazio_login'] = "Login é obrigatório";
    $continua = false;
    header('location: index.php');
} else {
    //$_SESSION['value_login'] = $_POST['login'];
}

if (empty($_POST['perfil']) && isset($_POST['perfil'])) {
    $_SESSION['vazio_perfil'] = "Selecione um perfil";
    $continua = false;
    header('location: index.php');
} else {
    //$_SESSION['value_perfil'] = $_POST['perfil'];
}

if (empty($_POST['status']) && isset($_POST['status'])) {
    $_SESSION['vazio_status'] = "Selecione um status";
    $continua = false;
    header('location: index.php');
} else {
    //$_SESSION['value_status'] = $_POST['status'];
}

if (isset($_POST['alterarSenha']) && $_POST['alterarSenha'] == 'alterarSenha') {
    $morador = $moradorDao->findById($_POST['id']);    
    $morador->setSenha($_POST['senha']);
    // echo "<pre>";
    // var_dump($morador);
    // echo "</pre>";
    $resultado = $moradorDao->save($morador);
    if ($resultado == 2) {
        $_SESSION['morador_erro'] = 'Erro ao alterar a senha';    
    }else {
        $_SESSION['morador_sucesso'] = "Senha alterada com sucesso!!!";
    }
    header('location: index.php');
}

if ($continua) {
    if (isset($_POST['salvar']) && $_POST['salvar'] == 'salvar') {
        $mor = $moradorDao->findById($_POST['id']);
        $senha = $mor->getSenha();        
        $morador->setNome($_POST['nome']);
        $morador->setLogin($_POST['login']);
        $morador->setCpf($_POST['cpf']);
        $morador->setSenha($senha);
        $morador->setStatus($_POST['status']);
        $perfil = $perfilDao->findById($_POST['perfil']);
        $morador->setPerfil($perfil);
        
        if ($_POST['id'] != '') {
            $morador->setId($_POST['id']);
            $resultado = $moradorDao->save($morador);
            if ($resultado == 2) {
                $_SESSION['morador_erro'] = 'Erro ao cadastrar';
                $_SESSION['cpf_existe'] = 'CPF digitado, já existe!';
            } else if ($resultado == 3) {
                $_SESSION['morador_erro'] = 'Erro ao cadastrar';
                $_SESSION['login_existe'] = 'Login digitado, já existe!';
            } else if ($resultado == 4) {
                $_SESSION['morador_erro'] = 'Erro ao cadastrar';
                $_SESSION['senha_vazio'] = 'É necessário digitar uma senha!';
            }else {
                $_SESSION['morador_sucesso'] = "Cadastrado com sucesso!!!";        
            }
            header('location: index.php');
        } else {
            $_SESSION['morador_erro'] = "Morador não cadastrado! Utilize a tela de login para cadastrar um novo morador";
            header('location: index.php');
        }
        
        // echo "<pre>";
        // var_dump($mor);
        // echo "</pre>";
        
        //return $resultado;
        //echo "<script>alert($resultado)</script>";        
    }
}




