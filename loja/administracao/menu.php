<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/css/all.css">
    <link rel="stylesheet" href="../assets/css/obrigatorio.css">
    <script src="../assets/js/jquery.js"></script>
    <script src="../assets/js/popper.js"></script>
    <script src="../assets/js/bootstrap.js"></script>
</head>
<body>

  <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <!-- Brand -->
      <a class="navbar-brand" href="<?=$home?>">Loja</a>

      <!-- Links -->
      <ul class="navbar-nav">
          <li class="nav-item">
              <a class="nav-link" href="#">Produto</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="#">Departamento</a>
          </li>

          <!-- Dropdown -->
          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Cadastrar</a>
          <div class="dropdown-menu">
              <a class="dropdown-item" href="../produto/">Produto</a>
              <a class="dropdown-item" href="../departamento/">Departamento</a>
              <a class="dropdown-item" href="../marca/">Marca</a>
              <a class="dropdown-item" href="../vendedor/">Vendedor</a>
              <a class="dropdown-item" href="../sexo/">Sexo</a>
          </div>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="../administracao/logout.php">Sair</a>
          </li>
      </ul>
  </nav>

</body>
</html>