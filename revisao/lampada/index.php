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
        <?php 
        require_once 'Lampada.php';
        $lampada = new Lampada('img/lampada-off.png', 'img/lampada-on.png');
        if (isset($_POST['desligar'])) {
            $lampada->desliga();
        } else {
            $lampada->liga();
        }
        ?>
        <img src="<?=$lampada->getImagem()?>" alt="Aqui fica a lâmpada">
        <!-- Início Form -->
        <form method="POST">
            <button name="ligar" type="submit">Ligar</button>
            <button name="desligar" type="submit">Desligar</button>
        </form>
        <!-- Fim Form -->
    </div>
    
</body>
</html>