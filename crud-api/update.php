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

// Recebe os dados do formulário
$id = $_POST['id'];
$nome = $_POST['nome'];
$idade = $_POST['idade'];

// Verifica se os dados foram enviados
if (!empty($id) && !empty($nome) && !empty($idade)) {
    // Query para atualizar os dados
    $stmt = $conn->prepare("UPDATE users SET nome = ?, idade = ? WHERE id = ?");
    $stmt->bind_param("sii", $nome, $idade, $id);

    // Executa a query
    if ($stmt->execute()) {
        echo "Usuário atualizado com sucesso!";
    } else {
        echo "Erro ao atualizar usuário: " . $stmt->error;
    }

    // Fecha o statement
    $stmt->close();
} else {
    echo "Preencha todos os campos.";
}

// Fecha a conexão
$conn->close();
?>
