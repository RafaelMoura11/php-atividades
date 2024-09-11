<?php
require 'conexao.php';

$action = isset($_GET['action']) ? $_GET['action'] : '';

if ($action == 'create') {
    // Create (Inserção de novo usuário)
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $idade = $_POST['idade'];

    if ($id) {
        // Update
        $sql = "UPDATE users SET nome='$nome', idade='$idade' WHERE id='$id'";
        if ($conn->query($sql) === TRUE) {
            echo "Usuário atualizado com sucesso!";
        } else {
            echo "Erro ao atualizar o usuário: " . $conn->error;
        }
    } else {
        // Insert
        $sql = "INSERT INTO users (nome, idade) VALUES ('$nome', '$idade')";
        if ($conn->query($sql) === TRUE) {
            echo "Usuário cadastrado com sucesso!";
        } else {
            echo "Erro ao cadastrar usuário: " . $conn->error;
        }
    }
} elseif ($action == 'read') {
    // Read (Listar todos os usuários)
    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table border='1'><tr><th>Nome</th><th>Idade</th><th>Ações</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['nome']}</td>
                    <td>{$row['idade']}</td>
                    <td>
                        <button class='editUser' data-id='{$row['id']}' data-nome='{$row['nome']}' data-idade='{$row['idade']}'>Editar</button>
                        <button class='deleteUser' data-id='{$row['id']}'>Excluir</button>
                    </td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "Nenhum usuário encontrado.";
    }
} elseif ($action == 'delete') {
    // Delete (Excluir usuário)
    $id = $_GET['id'];
    $sql = "DELETE FROM users WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "Usuário excluído com sucesso!";
    } else {
        echo "Erro ao excluir usuário: " . $conn->error;
    }
}

$conn->close();
?>
