<?php 
session_start();
if ($_SESSION['MoradorSituacao'] == NULL || $_SESSION['MoradorSituacao'] == '2') {
    header('location: ../assembleia/aguardando.php');
}

require_once(__DIR__ . "/../classes/modelo/Sindico.class.php");
require_once(__DIR__ . "/../classes/modelo/Morador.class.php");
require_once(__DIR__ . "/../classes/dao/SindicoDAO.class.php");
require_once(__DIR__ . "/../classes/dao/MoradorDAO.class.php");

$morId = $_GET['moradorId'];
$morador = new Morador();
$morador->setId($morId);
//$moradorDao = new MoradorDAO();

//$morador = $moradorDao->findById($morId);

$sindicoDao = new SindicoDAO();
$sindico = $sindicoDao->findMoradorId($morador);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Síndico</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>    
    <label for="nome" class="required">Nome</label>
    <!-- <input type="hidden" name="id" value="<//?=$sindico->getId();?>"> -->
    <input type="hidden" name="sindico" value="<?=$sindico->getMorador()->getId();?>">
    <input type="text" disabled="disabled" class="form-control" id="nome" name="nome" value="<?=$sindico->getMorador()->getNome();?>" maxlength="100" required />
</body>
</html>