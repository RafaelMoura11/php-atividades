<?php
// Configurações de conexão com o banco de dados
$host = 'localhost';
$db = 'cadastro';
$user = 'root';
$password = '';

// Conexão com o MySQL
$conn = new mysqli($host, $user, $password, $db);

// Verifica a conexão
if ($conn->connect_error) {
    die('Erro na conexão: ' . $conn->connect_error);
}

// Recebe o ID do usuário a ser deletado
$id = $_POST['id'];

// Verifica se o ID foi enviado
if (!empty($id)) {
    // Query para deletar o usuário
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);

    // Executa a query
    if ($stmt->execute()) {
        echo "Usuário deletado com sucesso!";
    } else {
        echo "Erro ao deletar usuário: " . $stmt->error;
    }

    // Fecha o statement
    $stmt->close();
} else {
    echo "ID do usuário não fornecido.";
}

// Fecha a conexão
$conn->close();
?>
