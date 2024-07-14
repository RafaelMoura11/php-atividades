<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tipos primitivos em PHP</title>
</head>
<body>
    <h1>Teste de tipos primitivos:</h1>
    <?php 
        $num = 3e2;
        echo "O valor da variável é $num <br/>";
        var_dump("Olá");
        echo "Helloooo";

        $float = 300.50;
        $int = (integer) $float;

        echo "<br/>$float";
        echo "<br/>$int";
        echo "<br/>";

        $isActive = false;
        var_dump($isActive);
        echo "<br/>";
        print "$isActive <br/>";
        
        $array = (string) [1, 2, 3, 4, 5];
        echo "$array<br/>";
        var_dump($array);
    ?>
</body>
</html>