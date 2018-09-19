<?php
include(__DIR__ . "/../administracao/logado.php");
require_once(__DIR__ . "/../classes/modelo/Dependente.class.php");
require_once(__DIR__ . "/../classes/dao/DependenteDAO.class.php");

$depDao = new DependenteDAO();
$dependente = new Dependente();

if (isset($_POST['salvar']) && $_POST['salvar'] == 'salvar') {
    $dependente->setId($_POST['id']);
    $dependente->setNome($_POST['nomeDependente']);
    $dependente->setCpf($_POST['cpfDependente']);
    if ($_POST['id'] != '') {
        $dependente->setId($_POST['id']);
    }
    $depDao->save($dependente);
    header('location: index.php');
}

if (isset($_POST['editar']) && $_POST['editar'] == 'editar') {
    $dependente = $depDao->findById($_POST['id']);
}
if (isset($_POST['remover']) && $_POST['remover'] == 'remover') {
    $depDao->remove($_POST['id']);
}

$dependentes = $depDao->findAll();
?>

<?php //PHP do responsável
require_once(__DIR__ . "/../classes/modelo/depMorador.class.php");
require_once(__DIR__ . "/../classes/dao/depMoradorDAO.class.php");
$responsavelDao = new depMoradorDAO();
$responsavel = new depMorador();
if (isset($_POST['salvarNovoDependente']) && $_POST['salvarNovoDependente'] == 'salvarNovoDependente') {
    $responsavel->getMorador()->setId($_POST['idMorador']);
    $responsavel->getDependente()->setId($_POST['idDependente']);
    $responsavelDao->insert($responsavel);
}
if (isset($_POST['removerResponsavel']) && $_POST['removerResponsavel'] == 'removerResponsavel') {
    $responsavelDao->remove($_POST['idDependente'], $_POST['idResponsavel']);
}
?>

<?php //PHP do email
require_once(__DIR__ . "/../classes/modelo/EmailDependente.class.php");
require_once(__DIR__ . "/../classes/dao/EmailDependenteDAO.class.php");
$emailDao = new EmailDependenteDAO();
$email = new EmailDependente();
if (isset($_POST['atualizarEmailDependente']) && $_POST['atualizarEmailDependente'] == 'atualizarEmailDependente') {
    $email->getDependente()->setId($_POST['idDependente']);
    $email->setEmail($_POST['emailAtua']);
    $emailDao->update($email);
}
if (isset($_POST['salvarNovoEmail']) && $_POST['salvarNovoEmail'] == 'salvarNovoEmail') {
    $email->getDependente()->setId($_POST['idDependente']);
    $email->setEmail($_POST['newEmail']);
    $emailDao->insert($email);
}
if (isset($_POST['removerEmail']) && $_POST['removerEmail'] == 'removerEmail') {
    $emailDao->remove($_POST['emailResponsavel']);
}
?>
<?php //PHP do telefone
require_once(__DIR__ . "/../classes/modelo/FoneDependente.class.php");
require_once(__DIR__ . "/../classes/dao/FoneDependenteDAO.class.php");
$foneDao = new FoneDependenteDAO();
$fone = new FoneDependente();
if (isset($_POST['salvarNovoTelefone']) && $_POST['salvarNovoTelefone'] == 'salvarNovoTelefone') {
    $fone->getDependente()->setId($_POST['idDependente']);
    $fone->setFone($_POST['newFone']);
    $foneDao->insert($fone);
}
if (isset($_POST['removerFone']) && $_POST['removerFone'] == 'removerFone') {
    $foneDao->remove($_POST['foneResponsavel']);
}
?>

<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>DEPENDENTES - ASSEMBLÉIA</title>
</head>
<body>
    <?php include(__DIR__ . "/../administracao/menu.php"); ?> <!-- include Menu -->

    <!-- Inicio do container -->
    <div class="container">
        <div class="row" style="margin-top: 5%;">
            <div class="col-md-12 mb-3">
                <fieldset>
                    <legend>Cadastro de Dependentes</legend>
                    <form method="post">
                        <div class="form-row">
                            <div class="col-md-2 mb-3">
                                <label for="cpfDependente">CPF</label>
                                <input type="hidden" name="id" value="<?=$dependente->getId();?>">
                                <input type="text" class="form-control" name="cpfDependente" id="cpfDependente" value="<?=$dependente->getCpf();?>" maxlength="11">
                            </div>
                            <div class="col-md-10 mb-3">
                                <label for="nomeDependente">Nome</label>
                                <input type="text" class="form-control" name="nomeDependente" id="nomeDependente" value="<?=$dependente->getNome();?>" required>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-block" name="salvar" value="salvar">
                                    Salvar
                                </button>
                            </div>
                        </div>
                    </form>
                </fieldset>
            </div>

            <div class="col-12">
                <fieldset>
                    <legend>Lista de Dependentes</legend>
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>CPF</th>
                                <th colspan="3">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($dependentes as $dependente): ?>
                                <tr>
                                    <td><?=$dependente->getId();?></td>
                                    <td><?=$dependente->getNome();?></td>
                                    <td><?=$dependente->getCpf();?></td>
                                    <td>
                                        <button type="submit" class="btn btn-info" name="" value="<?=$dependente->getId()?>" onclick="show_contatoDependente(this.value)" title="exibir/adicionar/remover informações do dependente">
                                            <i class="fas fa-file-contract"></i>
                                        </button>
                                    </td>
                                    <td>
                                        <form method="post">
                                            <input type="hidden" name="id" value="<?=$dependente->getId();?>">
                                            <button type="submit" class="btn btn-primary" name="editar" value="editar" title="editar nome e cpf do dependente">
                                                <i class="far fa-edit"></i>
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <form method="post">
                                            <input type="hidden" name="id" value="<?=$dependente->getId();?>">
                                            <button type="submit" class="btn btn-danger" name="remover" value="remover" onclick="return confirmRemoveDependente();" title="remover dependente">
                                                <i class="far fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <!-- Lista de emails/telefones do dependente selecionado -->
                    <div class="row" id="div-contatos-dep"></div>

                </fieldset>
            </div>
        </div>
    </div> <!-- Fim do container -->

    <!-- script -->
    <script src="../assets/js/ajax_funcoes.js"></script>
    <script src="../assets/js/remove.js"></script>
</body>
</html>