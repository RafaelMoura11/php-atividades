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

if (isset($_GET["nome"])) {
    $nome = $_GET["nome"];

    // Usando prepared statements para evitar SQL Injection
    $stmt = $conn->prepare("SELECT id, nome, idade FROM users WHERE nome LIKE ?");
    
    // Adiciona o wildcard "%" para pesquisar nomes que contenham a string
    $nome = '%' . $nome . '%';
    $stmt->bind_param("s", $nome);
    
    // Executa a query
    $stmt->execute();
    
    // Obtém o resultado
    $result = $stmt->get_result();
    
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

    // Fecha o statement
    $stmt->close();
} else {
    echo "Parâmetro 'nome' não fornecido.";
}

// Fecha a conexão
$conn->close();
?>