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
        <form action="tabuada_radio.php" method="post">
            <!-- Início Div Form-row -->
            <div class="form-row">
                <!-- Início radio -->
			    <div class="form-control col-md-12 mb-3" style="text-align:center">
                    <div>
                        <label>Tabuada com rádio</label>
                    </div>
                    <div class="form-check-inline">
                        <input class="form-check-input" type="radio" name="radio" id="inlineRadio1" value="1">
                        <label class="form-check-label" for="inlineRadio1" > 1 </label>
                    </div>
                    <div class="form-check-inline">
                        <input class="form-check-input" type="radio" name="radio" id="inlineRadio2" value="2">
                        <label class="form-check-label" for="inlineRadio2"> 2 </label>
                    </div>
                    <div class="form-check-inline">
                        <input class="form-check-input" type="radio" name="radio" id="inlineRadio3" value="3">
                        <label class="form-check-label" for="inlineRadio3"> 3 </label>
                    </div>
                    <div class="form-check-inline">
                        <input class="form-check-input" type="radio" name="radio" id="inlineRadio4" value="4">
                        <label class="form-check-label" for="inlineRadio4" > 4 </label>
                    </div>
                    <div class="form-check-inline">
                        <input class="form-check-input" type="radio" name="radio" id="inlineRadio5" value="5">
                        <label class="form-check-label" for="inlineRadio5"> 5 </label>
                    </div>
                    <div class="form-check-inline">
                        <input class="form-check-input" type="radio" name="radio" id="inlineRadio6" value="6">
                        <label class="form-check-label" for="inlineRadio6"> 6 </label>
                    </div>
                    <div class="form-check-inline">
                        <input class="form-check-input" type="radio" name="radio" id="inlineRadio7" value="7">
                        <label class="form-check-label" for="inlineRadio7"> 7 </label>
                    </div>
                    <div class="form-check-inline">
                        <input class="form-check-input" type="radio" name="radio" id="inlineRadio8" value="8">
                        <label class="form-check-label" for="inlineRadio8" > 8 </label>
                    </div>
                    <div class="form-check-inline">
                        <input class="form-check-input" type="radio" name="radio" id="inlineRadio9" value="9">
                        <label class="form-check-label" for="inlineRadio9"> 9 </label>
                    </div>
                </div>
			    <!-- Fim radio -->
                <!-- Início do button -->
                <div class="form-control col-md-12 mb-3" style="text-align:center">
                    <button type="submit" >Calcular</button>
                    <button href="tabuada_radio">Limpar</button>
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