<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <main>
        <?php 
        $number = $_POST["number"];
        if (!$number) {
            echo "Número inválido";
        } else {
            echo "O seu número é: " . $number;
            echo "<br/>O antecessor dele é: " . $number - 1;
            echo "<br/>O sucessor dele é: " . $number + 1;
        }
        ?>
    </main>
</body>
</html>