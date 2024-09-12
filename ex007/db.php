<?php
// Configuração de conexão com o banco de dados
$host = 'localhost';
$dbname = 'tarefas_db'; // Nome do banco de dados
$user = 'root'; // Usuário do banco
$password = ''; // Senha do banco (deixe vazio se for padrão)

// Criar a conexão
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    // Configura o PDO para lançar exceções em caso de erro
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Erro de conexão: ' . $e->getMessage());
}
?>
