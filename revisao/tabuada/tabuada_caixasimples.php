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
        <form action="tabuada_caixasimples.php">
            <!-- Início Div Form-row -->
            <div class="form-row">
                <!-- Início Caixa 1 -->
                <div class="form-group col-md-6 mb-3">
                    <label for="tabuada">Tabuada com caixa simples</label>
                    <input class="form-control" type="number" name="tabuada" id="tabuada" placeholder="Informe um número">
                </div>
                <!-- Fim  Caixa 1 -->
                
                <!-- Início do button -->
                <div class="form-control col-md-12 mb-3" style="text-align:center">
                    <button type="submit" >Calcular</button>
                    <button href="tabuada_caixasimples.php">Limpar</button>
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