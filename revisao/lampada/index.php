<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lâmpada</title>
    <style >
        div {
            text-align: center;
        }
        button {
            width: 90px;
        }
    </style>
</head>
<body>
    <div>
        <?php $lampada = 'img/lampada-off.png';
        if (!empty($_POST['ligar']) && $_POST['ligar'] == 'ligada') {
            $lampada = 'img/lampada-on.png';
        } ?>

        <img src="<?php echo $lampada; ?>">
    
        <!-- Início Form -->
        <form action="" method="POST">
            
            <button name="ligar" type="submit" value="ligada">Ligar</button>
            <button name="desligar" type="submit" value="desligada">Desligar</button>

        </form>
         
    </div>
    
</body>
</html>