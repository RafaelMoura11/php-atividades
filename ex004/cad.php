<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="stylesheet" href="../style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado</title>
</head>
<body>
    <header>
        <h1>Resultado do Processamento</h1>
    </header>
    <main>
        <?php
            $nome = $_GET["nome"];
            $sobrenome = $_GET["sobrenome"];
            $mensagem = $nome && $sobrenome ? "É um prazer, $nome $sobrenome" : "Nome não informado";
            echo "<p>$mensagem</p>";
        ?>
    </main>
</body>
</html>