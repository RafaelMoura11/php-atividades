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
$nome = $_POST['nome'];
$idade = $_POST['idade'];

// Verifica se os dados foram enviados
if (!empty($nome) && !empty($idade)) {
    // Query para inserir os dados
    $stmt = $conn->prepare("INSERT INTO users (nome, idade) VALUES (?, ?)");
    $stmt->bind_param("si", $nome, $idade);

    // Executa a query
    if ($stmt->execute()) {
        echo "Usuário cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar usuário: " . $stmt->error;
    }

    // Fecha o statement
    $stmt->close();
} else {
    echo "Preencha todos os campos.";
}

// Fecha a conexão
$conn->close();
?>
