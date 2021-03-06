<?php
//Tela de cadastro do Morador - Auto-Cadastro
session_start();
// if ($_SESSION['MoradorStatus'] == NULL) {
//     header('location: ../assembleia/aguardando.php');
// }

//include(__DIR__ . "/../administracao/logado.php");

require_once(__DIR__ . "/../classes/modelo/Morador.class.php");
require_once(__DIR__ . "/../classes/dao/MoradorDAO.class.php");
require_once(__DIR__ . "/../classes/modelo/Apartamento.class.php");
require_once(__DIR__ . "/../classes/dao/ApartamentoDAO.class.php");
require_once(__DIR__ . "/../classes/dao/MoradorRequisitadoDAO.class.php");
require_once(__DIR__ . "/../classes/modelo/Apartamento.class.php");
require_once(__DIR__ . "/../classes/modelo/Perfil.class.php");
require_once(__DIR__ . "/../classes/dao/PerfilDAO.class.php");
require_once(__DIR__ . "/../classes/modelo/Situacao.class.php");
require_once(__DIR__ . "/../classes/dao/SituacaoDAO.class.php");
require_once(__DIR__ . "/../classes/modelo/Ocupacao.class.php");
require_once(__DIR__ . "/../classes/dao/OcupacaoDAO.class.php");

$ocupacao = new Ocupacao();
$ocupacaoDao = new OcupacaoDAO();

$situacao = new Situacao();
$situacaoDao = new SituacaoDAO();

$perfil = new Perfil();
$perfilDao = new PerfilDAO();

$morador = new Morador();
$moradorDao = new MoradorDAO();

$apartamento = new Apartamento();
$apartamentoDao = new ApartamentoDAO();

$apartamentoRequisitado = new Apartamento();
$moradorRequisitado = new Morador();
$moradorRequisitadoDao = new MoradorRequisitadoDAO();

$continua = true;

// if (empty($_POST['nome']) && isset($_POST['nome'])) {
//     $_SESSION['vazio_nome'] = "O nome é obrigatório";
//     $continua = false;
//     header('location: index.php');
// } else {
//     $_SESSION['nome'] = $_POST['nome'];
// }

// if (empty($_POST['cpf']) &&  isset($_POST['cpf'])) {
//     $_SESSION['vazio_cpf'] = "CPF é obrigatório";
//     $cpf = $moradorDao->findCpf($_POST['cpf']);
//     //$num = count($cpf->getCpf());
//     if ($cpf == 1) {
//         //$_SESSION['cpf_existe'] = 'existe';
//         header('location: index.php');
//     }
//     $continua = false;
//     header('location: index.php');
// } 

// if (empty($_POST['login']) && isset($_POST['login'])) {
//     $_SESSION['vazio_login'] = "Login é obrigatório";
//     $continua = false;
//     header('location: index.php');
// }

// if (empty($_POST['senha']) && isset($_POST['senha'])) {
//     $_SESSION['vazio_senha'] = "Senha é obrigatório";
//     $continua = false;
//     header('location: index.php');
// } 

// if (empty($_POST['perfil']) && isset($_POST['perfil'])) {
//     $_SESSION['vazio_perfil'] = "Selecione um perfil";
//     $continua = false;
//     header('location: index.php');
// } 

// if (empty($_POST['status']) && isset($_POST['status'])) {
//     $_SESSION['vazio_status'] = "Selecione um status";
//     $continua = false;
//     header('location: index.php');
// } 

if ($continua) {
    if (isset($_POST['salvar']) && $_POST['salvar'] == 'salvar') {
        $moradorRequisitado = $moradorRequisitadoDao->findByCpf($_POST['cpf']);           
        if ($moradorRequisitado->getCpf() == NULL) {
            $morador->setNome($_POST['nome']);
            $morador->setLogin($_POST['login']);
            $morador->setCpf($_POST['cpf']);
            $morador->setSenha($_POST['senha']);
            $perfil = $perfilDao->findById(4); //Inicialmente, o usuário terá o perfil 4 - Usuário
            $morador->setPerfil($perfil); 
            $situacao = $situacaoDao->findById(1); //Inicialmente, o usuário terá situacao (1) Ativo.
            $morador->setSituacao($situacao);
            $apartamentoRequisitado = $moradorRequisitadoDao->findByApartamento($_POST['apartamentoId']);
            // echo "<pre>";
            // //var_dump($moradorRequisitado);
            // var_dump($apartamentoRequisitado);
            // echo "</pre>";
            if ($apartamentoRequisitado->getOcupacao()->getId() == 1) {
                $_SESSION['apartamento_ocupado'] = "Atenção, este apartamento encontra-se ocupado!";
                header('location: novoMorador.php');
                // echo "<pre>";
                // //var_dump($moradorRequisitado);
                // var_dump($apartamentoRequisitado);
                // echo "</pre>";
                
            } else {
                $ocupacao = $ocupacaoDao->findById(1);
                $apartamentoRequisitado->setOcupacao($ocupacao);
                // echo "teste1";
                // echo "<pre>";
                // //var_dump($moradorRequisitado);
                // var_dump($apartamentoRequisitado);
                // echo "</pre>";
                $moradorRequisitado = $moradorDao->save($morador);
                $apartamentoRequisitado = $apartamentoDao->save($apartamentoRequisitado);
                
                $resultado = $moradorRequisitadoDao->save($moradorRequisitado, $apartamentoRequisitado);
                // echo "teste2";
                // echo "<pre>";
                // //var_dump($moradorRequisitado);
                // var_dump($resultado);
                // echo "</pre>";
                $_SESSION['morador_sucesso'] = "Cadastrado com sucesso!!!";
                header('location: novoMorador.php');
            }
        } else {
            $morador->setNome($_POST['nome']);
            $morador->setLogin($_POST['login']);
            $morador->setCpf($_POST['cpf']);
            $morador->setSenha($_POST['senha']);
            $perfil = $perfilDao->findById(4); //Inicialmente, o usuário terá o perfil 4 - Usuário
            $morador->setPerfil($perfil); 
            $situacao = $situacaoDao->findById(1); //Inicialmente, o usuário terá situacao (1) Ativo.
            $morador->setSituacao($situacao);
            $resultado = $moradorDao->save($morador);
           
            // echo "<pre>";
            // //var_dump($moradorRequisitado);
            // var_dump($resultado);
            // echo "</pre>";
            if ($resultado == 2) {
                $_SESSION['morador_erro'] = 'Erro ao cadastrar';
                $_SESSION['cpf_existe'] = 'CPF digitado, já existe!';
            } else if ($resultado == 3) {
                $_SESSION['morador_erro'] = 'Erro ao cadastrar';
                $_SESSION['login_existe'] = 'Login digitado, já existe!';
            } else {
                $_SESSION['morador_sucesso'] = "Cadastrado com sucesso!!!";
                if ($resultado == "SQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry '22222222222' for key 'UK_MOR_CPF'"){
                }
                //echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=index.php'><script type=\"text/javascript\">alert(\"Cadastro realizado com sucesso.\");</script>";
            }
            header('location: novoMorador.php');

            // }
        }             
        
        //return $resultado;
        //echo "<script>alert($resultado)</script>";
        
        //     // $_SESSION['morador_erro'] = "Erro ao cadastrar";
        //     //echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=index.php'><script type=\"text/javascript\">alert(\"Erro ao cadastrar.\");</script>";  
        // // echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL= index.php'";
        //header('location: ../index.php');
    }
}




