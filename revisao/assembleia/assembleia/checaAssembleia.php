<?php 
session_start();
include(__DIR__ . "/../administracao/logado.php");
require_once(__DIR__ . "/../classes/modelo/Assembleia.class.php");
require_once(__DIR__ . "/../classes/modelo/TipoAssembleia.class.php");
require_once(__DIR__ . "/../classes/dao/AssembleiaDAO.class.php");
require_once(__DIR__ . "/../classes/dao/TipoAssembleiaDAO.class.php");
 
$assembleia = new Assembleia();
$assembleiaDao = new AssembleiaDAO();

$tipoAssembleia = new TipoAssembleia();
$tipoAssembleiaDao = new TipoAssembleiaDAO();

$continua = true;

if (empty($_POST['nome']) && isset($_POST['nome'])) {
    $_SESSION['vazio_nome'] = "O nome é obrigatório";
    $continua = false;
    header('location: index.php');
} 

if (empty($_POST['data']) &&  isset($_POST['data'])) {
    $_SESSION['vazio_data'] = "Data é obrigatória";    
    $continua = false;
    header('location: index.php');
}

if (empty($_POST['tipoAssembleia']) &&  isset($_POST['tipoAssembleia'])) {
    $_SESSION['vazio_tipo'] = "Tipo de Assembléia é obrigatório";    
    $continua = false;
    header('location: index.php');
}

if ($continua) {
    if (isset($_POST['salvar']) && $_POST['salvar'] == 'salvar') {
        $assembleia->setNome($_POST['nome']);
        $assembleia->setData($_POST['data']);
        $tipoAssembleia = $tipoAssembleiaDao->findById($_POST['tipoAssembleia']);
        $assembleia->setTipoAssembleia($tipoAssembleia);

        if ($_POST['id'] != '') {
            $assembleia->setId($_POST['id']);
        }
        
        $resultado = $assembleiaDao->save($assembleia);
        // return $resultado;
        //echo "<script>alert($resultado)</script>";
        
        if ($resultado != 0) {
            $_SESSION['assembleia_erro'] = 'Erro ao cadastrar';
            if($resultado == 1) {
                $_SESSION['data_existe'] = 'Data indisponível. Selecione outra data!';
            }else if ($resultado == 2) {
                $_SESSION['tipo_null'] = 'Tipo de Assembléia Null!';
            }
        } else {
            $_SESSION['assembleia_sucesso'] = "Cadastrado com sucesso!!!";
        }
        header('location: index.php');
    }
}

