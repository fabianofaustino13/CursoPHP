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
        <form action="escolha.php">
            <!-- Início Div Form-row -->
            <div class="form-row">         
                <!-- Início radio -->
			    <div class="form-control col-md-12 mb-3" style="text-align:center">
                    <div>
                        <label>Escolha uma opção de tabuada</label>
                    </div>
                    <div class="form-check-inline">
                        <input class="form-check-input" type="radio" name="radio" id="inlineRadio1" value="1">
                        <label class="form-check-label" for="inlineRadio1" > Utilizando de texto simples </label>
                    </div>
                    <div class="form-check-inline">
                        <input class="form-check-input" type="radio" name="radio" id="inlineRadio2" value="2">
                        <label class="form-check-label" for="inlineRadio2"> Utilizando Select </label>
                    </div>
                    <div class="form-check-inline">
                        <input class="form-check-input" type="radio" name="radio" id="inlineRadio3" value="3">
                        <label class="form-check-label" for="inlineRadio3"> Utilizando RadioButton </label>
                    </div>
                </div>
			    <!-- Fim radio -->
                <!-- Início do button -->
                <div class="form-control col-md-12 mb-3" style="text-align:center">
                    <button type="submit" >Calcular</button>
                    <button type="reset">Limpar</button>
                </div>
                <!-- Fim do button -->
            </div>
            <!-- Fim Div Form-row -->
        </form>
        <!-- Fim Form -->
        <!-- <div class="form-control posicao">
            
            <div>
                <?php include 'repeticao1.php'; ?>
            </div>
        </div> -->
    </div>
    <!-- Fim Container -->
    
    
</body>
</html>