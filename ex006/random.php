<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Números aleatórios</title>
</head>
<body>
    <main>
        <h1>Clique no botão para gerara um número aleatório:</h1>
        <button onclick="javascript:document.location.reload()">Clique aqui</button>
        <?php 
            $min = 0;
            $max = 100;
            $num = mt_rand($min, $max);
            echo "<p>O número aleatório gerado entre $min e $max é: $num</p>"
        ?>
    </main>
</body>
</html>