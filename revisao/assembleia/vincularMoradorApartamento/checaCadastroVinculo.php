<?php
session_start();
include(__DIR__ . "/../administracao/logado.php");

require_once(__DIR__ . "/../classes/modelo/Morador.class.php");
require_once(__DIR__ . "/../classes/dao/MoradorDAO.class.php");
require_once(__DIR__ . "/../classes/modelo/Apartamento.class.php");
require_once(__DIR__ . "/../classes/dao/ApartamentoDAO.class.php");
require_once(__DIR__ . "/../classes/modelo/Bloco.class.php");
require_once(__DIR__ . "/../classes/dao/BlocoDAO.class.php");
require_once(__DIR__ . "/../classes/modelo/Perfil.class.php");
require_once(__DIR__ . "/../classes/dao/PerfilDAO.class.php");

$perfil = new Perfil();
$perfilDao = new PerfilDAO();

$bloco = new Bloco();
$blocoDao = new BlocoDAO();

$apartamento = new Apartamento();
$apartamentoDao = new ApartamentoDAO();

$morador = new Morador();
$moradorDao = new MoradorDAO();
$cpf = new Morador();

$continua = true;

if (empty($_POST['id']) && isset($_POST['id'])) {
    $_SESSION['vazio_nome'] = "O nome é obrigatório";
    $continua = false;
    header('location: index.php');
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
}

if (empty($_POST['blocoId']) && isset($_POST['blocoId'])) {
    $_SESSION['vazio_blocoId'] = "Selecione um bloco";
    $continua = false;
    header('location: index.php');
} else {
    $_SESSION['value_blocoId'] = $_POST['blocoId'];
}

if (empty($_POST['apartamentoId']) && isset($_POST['apartamentoId'])) {
    $_SESSION['vazio_apartamentoId'] = "Selecione um apartamento";
    $continua = false;
    header('location: index.php');
} else {
    $_SESSION['value_apartamentoId'] = $_POST['apartamentoId'];
}

if ($continua) {
    if (isset($_POST['salvar']) && $_POST['salvar'] == 'salvar') {
        $morador = $moradorDao->findById($_POST['id']);
        $apartamento = $apartamentoDao->findById($_POST['apartamentoId']);
        $apartamento->setMorador($morador);
        $resultado = $apartamentoDao->save($apartamento);
        
        // echo "<pre>";
        // var_dump($resultado);
        // echo "</pre>";
        // $apartamento->setId($apartamento);
        // $apartamento->setMorador()
        // $apartamento->getBloco()->setId($_POST['blocoId']);
        // $apartamento->setId($_POST['apartamentoId']);         

        //$resultadoApto = $apartamentoDao->save($apartamento);
        
        //return $resultado;
        //echo "<script>alert($resultado2)</script>";
        if ($resultado != null) {
            $_SESSION['vinculo_sucesso'] = "Vinculado com sucesso!!!";
        } else {
            $_SESSION['vinculo_erro'] = "Erro ao Vincular Morador ao Apartamento!!!";
        }


        // if ($resultado == 2) {
        //     $_SESSION['morador_erro'] = 'Erro ao cadastrar';
        //     $_SESSION['cpf_existe'] = 'CPF digitado, já existe!';
        // } else if ($resultado == 3) {
        //     $_SESSION['morador_erro'] = 'Erro ao cadastrar';
        //     $_SESSION['login_existe'] = 'Login digitado, já existe!';
        // }else {
        //     $_SESSION['morador_sucesso'] = "Cadastrado com sucesso!!!";
        //     // if ($resultado == "SQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry '22222222222' for key 'UK_MOR_CPF'"){
        //     // }
        //     //echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=index.php'><script type=\"text/javascript\">alert(\"Cadastro realizado com sucesso.\");</script>";
        // }
        //     // $_SESSION['morador_erro'] = "Erro ao cadastrar";
        //     //echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=index.php'><script type=\"text/javascript\">alert(\"Erro ao cadastrar.\");</script>";  
        // // echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL= index.php'";
        header('location: index.php');
    }
}




