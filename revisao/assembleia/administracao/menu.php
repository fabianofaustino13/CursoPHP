<?php
// include(__DIR__ . "/../administracao/logado.php");

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Assembleia</title>
	<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
	<!-- <link rel="stylesheet" type="text/css" href="../assets/css/base.css"> -->
    <!-- <link rel="stylesheet" type="text/css" href="../assets/css/style.css"> -->
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/home2.css">
    <link rel="stylesheet" href="../assets/css/all.css">
	<!-- <link rel="stylesheet" type="text/css" href="../assets/css/login.css"> -->
	<!-- <link rel="stylesheet" type="text/css" href="../assets/css/botoes.css"> -->
	<!-- <link rel="stylesheet" type="text/css" href="../assets/css/responsive.css"> -->
</head>

    <!-- Menu lateral -->
        <div class="sidenav">
            <div>
                <a href="../editaMorador/index.php">
                    <p style='text-align: center; color:yellow; font-size:14px;'>
                        <?php if ($_SESSION['MoradorPerfilID'] == 1):?>
                            <i class="fab fa-angellist fa-1x"></i> 
                            <br><?=$_SESSION['MoradorNome']?><br>
                            (<?=$_SESSION['MoradorPerfilNome']?>)
                        <?php elseif ($_SESSION['MoradorPerfilID'] == 2):?>
                            <i class="fas fa-balance-scale fa-1x"></i>
                            <br><?=$_SESSION['MoradorNome']?><br>
                            (<?=$_SESSION['MoradorPerfilNome']?>)                   
                        <?php elseif ($_SESSION['MoradorPerfilID'] == 3):?>
                            <i class="fas fa-award fa-1x"></i>
                            <br><?=$_SESSION['MoradorNome']?><br>
                            (<?=$_SESSION['MoradorPerfilNome']?>)
                        <?php elseif (($_SESSION['MoradorPerfilID'] == 4) AND ($_SESSION['MoradorSituacao'] == 2)):?>
                            <i class="fas fa-chalkboard-teacher"></i>
                            <br><?=$_SESSION['MoradorNome']?><br>
                            (<?=$_SESSION['MoradorPerfilNome']?>)
                        <?php endif; ?>                                
                    </p>            
                </a>
            </div>

            <a href="../index.php"><i class="fa fa-home"></i> <span>Home</span></a>           
            <?php if ($_SESSION['MoradorSituacao'] == 1): ?>
                <button class="dropdown-btn"><i class="fa fa-list-alt"></i> <span>Cadastrar</span>  
                    <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-container">
                    <button class="dropdown-btn"> <i class="fas fa-clipboard-list"></i> <span>Assembléias</span>  
                        <i class="fa fa-caret-down"></i>
                    </button>
                    <div class="dropdown-container">
                        <a href="../assembleia/index.php">Assembléia</a>  
                        <a href="../tipoAssembleia/index.php">Tipo de Assembléia</a>
                    </div>
                    <button class="dropdown-btn"><i class="fas fa-list"></i></i> <span>Pautas</span>  
                        <i class="fa fa-caret-down"></i>
                    </button>
                    <div class="dropdown-container">
                        <a href="../pauta/index.php">Pauta</a>
                        <a href="../opcaoResposta/index.php">Resposta</a>                 
                    </div>
                    <a href="../morador/novoMorador.php"><i class="fa fa-users"></i> <span>Cadastrar Morador</span> </a>
                    <a href="../morador/index.php"><i class="fa fa-users"></i> <span>Morador</span> </a>
                    <a href="../morador/indexOld.php"><i class="fa fa-users"></i> <span>Morador Old</span> </a>
                    <a href="../sindico/index.php"><i class="fa fa-user"></i> <span>Síndico</span> </a>
                    <a href="../adimplente/index.php"><i class="fas fa-dollar-sign"></i> <span>Situação Financeira</span> </a>
                    <a href="../apartamento/index.php"><i class="fas fa-building"></i> <span>Apartamento</span> </a>
                </div>
                <button class="dropdown-btn"><i class="fa fa-list-alt"></i> <span>Gerenciar</span>  
                    <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-container">
                    <a href="../morador/gerenciarMorador.php"><i class="fab fa-gg"></i> <span>Morador</span> </a>
                    <a href="../vincularApartamentoMorador/index.php"><i class="fab fa-gg"></i> <span>Vincular Morador</span> </a>
                    <a href="../resultadoVotacao/index.php"><i class="fab fa-gg"></i> <span>Resultado Votação</span> </a>
                    <a href="../votacao/index.php"><i class="fab fa-gg"></i> <span>Votação</span> </a>
                </div>
            <?php endif;?>
    
            <a href="../administracao/logout.php" style="color: red"><i class="fas fa-sign-out-alt"></i><span>Sair</span></a>
                
        </div>

    <script>
      //* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
        var dropdown = document.getElementsByClassName("dropdown-btn");
        var i;

        for (i = 0; i < dropdown.length; i++) {
        dropdown[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var dropdownContent = this.nextElementSibling;
            if (dropdownContent.style.display === "block") {
            dropdownContent.style.display = "none";
            } else {
            dropdownContent.style.display = "block";
            }
        });
        }
        </script>
    <!-- Fim menu lateral -->

</html>