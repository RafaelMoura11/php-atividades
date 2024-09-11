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

// Query para buscar todos os usuários
$sql = "SELECT id, nome, idade FROM users";
$result = $conn->query($sql);

// Verifica se há resultados
if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Idade</th>
            </tr>";
    
    // Exibe os dados
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['nome']}</td>
                <td>{$row['idade']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "Nenhum usuário encontrado.";
}

// Fecha a conexão
$conn->close();
?>
