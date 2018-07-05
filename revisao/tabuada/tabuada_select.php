<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/tabuada.css">
    <title>Tabuada</title>
</head>
<body>
    <!-- Início Container -->
    <div class="container">
        <!-- Início Form -->
        <form action="tabuada_select.php" method="post">
            <!-- Início Div Form-row -->
            <div class="form-row">
                <!-- Início Select -->
                <div class="form-group  col-md-6 mb-3">
                    <label for="select">Tabuada com select</label>
                    <select class="form-control" name="select" id="select">
                        <option disabled selected>Escolha um número</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                    </select>
                </div>
                <!-- Fim Select -->
                <!-- Início do button -->
                <div class="form-control col-md-12 mb-3" style="text-align:center">
                    <button type="submit" >Calcular</button>
                    <button href="tabuada_select">Limpar</button>
                    <a href="tab.php"><input type="button" value="Home"></a>
                </div>
                <!-- Fim do button -->
            </div>
            <!-- Fim Div Form-row -->
        </form>
        <!-- Fim Form -->
        <div class="form-control posicao">
            
            <div>
                <?php include 'repeticao1.php'; ?>
            </div>
        </div>
    </div>
    <!-- Fim Container -->
    
    
</body>
</html>