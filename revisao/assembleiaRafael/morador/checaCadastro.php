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

if (empty($_POST['nome']) && isset($_POST['nome'])) {
    $_SESSION['vazio_nome'] = "O nome é obrigatório";
    $continua = false;
    header('location: index.php');
} else {
    $_SESSION['value_nome'] = $_POST['nome'];
}
if (empty($_POST['cpf']) &&  isset($_POST['cpf'])) {
    $_SESSION['vazio_cpf'] = "CPF é obrigatório";
    $cpf = $moradorDao->findCpf($_POST['cpf']);
    $num = count($cpf->getCpf());
    if ($num > 0) {
        $_SESSION['cpf_existe'] = '$num';
        header('location: index.php');
    }
    $continua = false;
    header('location: index.php');
} else {
    $_SESSION['value_cpf'] = $_POST['cpf'];
}

if ($continua) {
    if (isset($_POST['salvar']) && $_POST['salvar'] == 'salvar') {
        $morador->setNome($_POST['nome']);
        $morador->setLogin($_POST['login']);
        $morador->setCpf($_POST['cpf']);
        $morador->setSenha($_POST['senha']);
        $morador->setStatus($_POST['sindico']);
        $perfil = $perfilDao->findById($_POST['perfil']);
        $morador->setPerfil($perfil);
        
        if ($_POST['id'] != '') {
            $morador->setId($_POST['id']);
        }
    
        $apartamento->getBloco()->setId($_POST['blocoId']);
        $apartamento->setId($_POST['apartamentoId']);
        
        $resultado = $moradorDao->save($morador, $apartamento);
        
        if ($resultado != null) {
            $_SESSION['cadastro_morador'] = "Cadastrado com Sucesso!!!";
            //echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=index.php'><script type=\"text/javascript\">alert(\"Cadastro realizado com sucesso.\");</script>";
        } else {
            $_SESSION['morador_erro'] = "Erro ao cadastrar";
            //echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=index.php'><script type=\"text/javascript\">alert(\"Erro ao cadastrar.\");</script>";
        }  
        // echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL= index.php'";
        header('location: index.php');
    }
}




