<?php
session_start();
if ($_SESSION['MoradorSituacao'] == NULL || $_SESSION['MoradorSituacao'] == '2') {
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
require_once(__DIR__ . "/../classes/modelo/Situacao.class.php");
require_once(__DIR__ . "/../classes/dao/SituacaoDAO.class.php");
require_once(__DIR__ . "/../classes/dao/MoradorRequisitadoDAO.class.php");
require_once(__DIR__ . "/../classes/modelo/Ocupacao.class.php");
require_once(__DIR__ . "/../classes/dao/OcupacaoDAO.class.php");

$perfil = new Perfil();
$perfilDao = new PerfilDAO();

$situacao = new Situacao();
$situacaoDao = new SituacaoDAO();

$bloco = new Bloco();
$blocoDao = new BlocoDAO();

$apartamento = new Apartamento();
$apartamentoDao = new ApartamentoDAO();

$morador = new Morador();
$mor = new Morador();
$moradorDao = new MoradorDAO();
$cpf = new Morador();

$apartamentoRequisitado = new Apartamento();
$moradorRequisitado = new Morador();
$moradorRequisitadoDao = new MoradorRequisitadoDAO();
$ocupacao = new Ocupacao();
$ocupacaoDao = new OcupacaoDAO();

$continua = true;

if ((isset($_POST['limpar']) && $_POST['limpar'] == 'limpar')) {
    header('location: indexOld.php');
}
if (empty($_POST['nome']) && isset($_POST['nome'])) {
    $_SESSION['vazio_nome'] = "O nome é obrigatório";
    $continua = false;
    header('location: indexOld.php');
} else {
    //$_SESSION['value_nome'] = $_POST['nome'];
}
if (empty($_POST['cpf']) &&  isset($_POST['cpf'])) {
    $_SESSION['vazio_cpf'] = "CPF é obrigatório";
    $cpf = $moradorDao->findCpf($_POST['cpf']);
    //$num = count($cpf->getCpf());
    if ($cpf == 1) {
        //$_SESSION['cpf_existe'] = 'existe';
        header('location: indexOld.php');
    }
    $continua = false;
    header('location: indexOld.php');
} else {
    //$_SESSION['value_cpf'] = $_POST['cpf'];
}

if (empty($_POST['login']) && isset($_POST['login'])) {
    $_SESSION['vazio_login'] = "Login é obrigatório";
    $continua = false;
    header('location: indexOld.php');
} else {
    //$_SESSION['value_login'] = $_POST['login'];
}

if (empty($_POST['perfil']) && isset($_POST['perfil'])) {
    $_SESSION['vazio_perfil'] = "Selecione um perfil";
    $continua = false;
    header('location: indexOld.php');
} else {
    //$_SESSION['value_perfil'] = $_POST['perfil'];
}

if (empty($_POST['situacao']) && isset($_POST['situacao'])) {
    $_SESSION['vazio_situacao'] = "Selecione uma situacao";
    $continua = false;
    header('location: indexOld.php');
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
    header('location: indexOld.php');
}

if ($continua) {
    if (isset($_POST['salvar']) && $_POST['salvar'] == 'salvar') {
        //$resultado = 100;
        //if ($morador->getSituacao()->getId() == 2) {
        $mor = $moradorDao->findById($_POST['id']); //reservado para preservar a senha já digitada
        $senha = $mor->getSenha(); //reservado para preservar a senha já digitada
        $morador->setId($_POST['id']);       
        $morador->setNome($_POST['nome']);
        $morador->setLogin($_POST['login']);
        $morador->setCpf($_POST['cpf']);
        $morador->setSenha($senha);
        $situacao = $situacaoDao->findById($_POST['situacao']);
        $morador->setSituacao($situacao);
        $perfil = $perfilDao->findById($_POST['perfil']);
        $morador->setPerfil($perfil);
        if ($_POST['id'] != '') {            
            if ($_POST['situacao'] == 2) {
                $resultado = $moradorDao->save($morador);
                // echo "teste1";
                // echo "<pre>";
                // var_dump($resultado);
                // //var_dump($teste);
                // var_dump($morador);
                // //var_dump($apartamentoRequisitado);
                // echo "</pre>";
                $apartamentoRequisitado = $moradorRequisitadoDao->findByApartamento($_POST['ID_apartamento']);
                $ocupacao = $ocupacaoDao->findById(2);
                $apartamentoRequisitado->setOcupacao($ocupacao);
                $apartamentoRequisitado = $apartamentoDao->save($apartamentoRequisitado);  
                header('location: indexOld.php');          
            } else {
                // $mor = $moradorDao->findById($_POST['id']); //reservado para preservar a senha já digitada
                // $senha = $mor->getSenha(); //reservado para preservar a senha já digitada
                // $morador->setId($_POST['id']);       
                // $morador->setNome($_POST['nome']);
                // $morador->setLogin($_POST['login']);
                // $morador->setCpf($_POST['cpf']);
                // $morador->setSenha($senha);
                // $situacao = $situacaoDao->findById($_POST['situacao']);
                // $morador->setSituacao($situacao);
                // $perfil = $perfilDao->findById($_POST['perfil']);
                // $morador->setPerfil($perfil);
                $resultado = $moradorDao->save($morador);
                $apartamentoRequisitado = $moradorRequisitadoDao->findByApartamento($_POST['ID_apartamento']);
                $ocupacao = $ocupacaoDao->findById(1);
                $apartamentoRequisitado->setOcupacao($ocupacao);
                $apartamentoRequisitado = $apartamentoDao->save($apartamentoRequisitado);  
                header('location: indexOld.php'); 
                // echo "teste3";
                // echo "<pre>";
                // var_dump($resultado);
                // // var_dump($moradorRequisitado);
                // // var_dump($apartamentoRequisitado);
                // echo "</pre>";
            }
            //$morador->setId($_POST['id']);
            //$resultado = $moradorDao->save($morador);
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
                $_SESSION['morador_sucesso'] = "Atualizado com sucesso!!!";        
            }
            //header('location: indexOld.php');
        } else {
            $_SESSION['morador_erro'] = "Morador não cadastrado! Utilize a tela de cadastro de morador para cadastrar um novo morador";
           // header('location: indexOld.php');
        
        //if ($_POST['id'] != '') {
        } //else {
            // $morador->setId($_POST['id']);
            // //$resultado = $moradorDao->save($morador);
            // if ($resultado == 2) {
            //     $_SESSION['morador_erro'] = 'Erro ao cadastrar';
            //     $_SESSION['cpf_existe'] = 'CPF digitado, já existe!';
            // } else if ($resultado == 3) {
            //     $_SESSION['morador_erro'] = 'Erro ao cadastrar';
            //     $_SESSION['login_existe'] = 'Login digitado, já existe!';
            // } else if ($resultado == 4) {
            //     $_SESSION['morador_erro'] = 'Erro ao cadastrar';
            //     $_SESSION['senha_vazio'] = 'É necessário digitar uma senha!';
            // }else {
            //     $_SESSION['morador_sucesso'] = "Cadastrado com sucesso!!!";        
            // }
            //header('location: indexOld2.php');
        // } else {
        //     $_SESSION['morador_erro'] = "Morador não cadastrado! Utilize a tela de login para cadastrar um novo morador";
        //     header('location: indexOld3.php');
        //}
        
        // echo "<pre>";
        // var_dump($mor);
        // echo "</pre>";
        
        //return $resultado;
        //echo "<script>alert($resultado)</script>";        
    }
}




