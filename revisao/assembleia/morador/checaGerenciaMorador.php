<?php
session_start();
if ($_SESSION['MoradorSituacao'] == NULL || $_SESSION['MoradorSituacao'] == '2') {
    header('location: ../assembleia/aguardando.php');
}

include(__DIR__ . "/../administracao/logado.php");

require_once(__DIR__ . "/../classes/modelo/Morador.class.php");
require_once(__DIR__ . "/../classes/dao/MoradorDAO.class.php");
require_once(__DIR__ . "/../classes/modelo/Perfil.class.php");
require_once(__DIR__ . "/../classes/dao/PerfilDAO.class.php");

$perfil = new Perfil();
$perfilDao = new PerfilDAO();

$morador = new Morador();
$moradorDao = new MoradorDAO();

$continua = true;

// if (empty($_POST['nome']) && isset($_POST['nome'])) {
//     $_SESSION['vazio_nome'] = "O nome é obrigatório";
//     $continua = false;
//     header('location: gerenciarMorador.php');
// } 
// if (empty($_POST['cpf']) &&  isset($_POST['cpf'])) {
//     $_SESSION['vazio_cpf'] = "CPF é obrigatório";
//     $cpf = $moradorDao->findCpf($_POST['cpf']);
//     //$num = count($cpf->getCpf());
//     if ($cpf == 1) {
//         //$_SESSION['cpf_existe'] = 'existe';
//         header('location: gerenciarMorador.php');
//     }
//     $continua = false;
//     header('location: gerenciarMorador.php');
// } 

// if (empty($_POST['login']) && isset($_POST['login'])) {
//     $_SESSION['vazio_login'] = "Login é obrigatório";
//     $continua = false;
//     header('location: gerenciarMorador.php');
// } 

if (empty($_POST['perfil']) && isset($_POST['perfil'])) {
    $_SESSION['vazio_perfil'] = "Selecione um perfil";
    $continua = false;
    header('location: gerenciarMorador.php');
} 

if (empty($_POST['status']) && isset($_POST['status'])) {
    $_SESSION['vazio_status'] = "Selecione um status";
    $continua = false;
    header('location: gerenciarMorador.php');
} 

if ($continua) {
    if (isset($_POST['salvar']) && $_POST['salvar'] == 'salvar') {
        $morador = $moradorDao->findById($_POST['id']);
        // $morador->setNome($_POST['nome']);
        // $morador->setLogin($_POST['login']);
        // $morador->setCpf($_POST['cpf']);
        $perfil = $perfilDao->findById($_POST['perfil']);
        $morador->setPerfil($perfil);
        $morador->setStatus($_POST['status']);
               
        $resultado = $moradorDao->save($morador);
        // $apartamento = $apartamentoDao->findById($_POST['apartamentoId']);
        //$apartamento = $apartamentoDao->findById($_POST['apartamentoId']);
        //$apartamento->setMorador($resultado);
        //$resultado2 = $apartamentoDao->save($apartamento);
        
        // echo "<pre>";
        // var_dump($resultado);
        // echo "</pre>";
        // $apartamento->setId($apartamento);
        // $apartamento->setMorador()
        // $apartamento->getBloco()->setId($_POST['blocoId']);
        // $apartamento->setId($_POST['apartamentoId']);         

        //$resultadoApto = $apartamentoDao->save($apartamento);
        
        //return $resultado;
        //echo "<script>alert($resultado)</script>";
        
        if ($resultado == 2) {
            $_SESSION['morador_erro'] = 'Erro ao cadastrar';
            $_SESSION['cpf_existe'] = 'CPF digitado, já existe!';
        } else if ($resultado == 3) {
            $_SESSION['morador_erro'] = 'Erro ao cadastrar';
            $_SESSION['login_existe'] = 'Login digitado, já existe!';
        }else {
            $_SESSION['morador_sucesso'] = "Cadastrado com sucesso!!!";
            // if ($resultado == "SQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry '22222222222' for key 'UK_MOR_CPF'"){
            // }
            //echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=index.php'><script type=\"text/javascript\">alert(\"Cadastro realizado com sucesso.\");</script>";
        }
        //     // $_SESSION['morador_erro'] = "Erro ao cadastrar";
        //     //echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=index.php'><script type=\"text/javascript\">alert(\"Erro ao cadastrar.\");</script>";  
        // // echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL= index.php'";
        header('location: gerenciarMorador.php');
    }
}




