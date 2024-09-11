<?php
// Configuração da conexão
$servername = "localhost";
$username = "root"; // Usuário do MySQL
$password = ""; // Senha do MySQL
$dbname = "cadastro"; // Nome do banco de dados

// Criação da conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
?>
