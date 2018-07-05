<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tabuada</title>
</head>
<body>
    <form action="tabuada.php" method="post">
        <label for="tabuada">Tabuada:</label>
        <input type="number" name="tabuada" id="tabuada">
        <button type="submit" >Calcular</button>
        <button href="tabuada.php">Limpar</button>
    </form>
    <?php include 'repeticao1.php'; ?>
</body>
</html>