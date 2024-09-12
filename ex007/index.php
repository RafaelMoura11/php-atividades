<?php 
require 'db.php'; // Inclui o arquivo de conexão com o banco de dados

// Adicionar tarefa
if (isset($_GET['method']) && $_GET['method'] == "read") {
    $search = $_GET['search'];
    $search = "$search%";
    $stmt = $pdo->prepare("SELECT * FROM tarefas WHERE tarefas.descricao LIKE ?");
    $stmt->execute([$search]);
    $tarefas = $stmt->fetchAll(); // Obtém todas as tarefas do banco de dados
    exit();
}

// Adicionar tarefa
if (isset($_POST['method']) && $_POST['method'] == "create") {
    $tarefa = $_POST['tarefa'];
    if (!empty($tarefa)) {
        // Inserir tarefa no banco de dados
        $stmt = $pdo->prepare("INSERT INTO tarefas (descricao) VALUES (?)");
        $stmt->execute([$tarefa]); // Executa a inserção da nova tarefa
    }
    exit();
}

// Remover tarefa
if (isset($_POST['method']) && $_POST['method'] == "delete") {
    $key = $_POST['key'];
    // Deletar tarefa do banco de dados pelo ID
    $stmt = $pdo->prepare("DELETE FROM tarefas WHERE id = ?");
    $stmt->execute([$key]); // Executa a exclusão da tarefa
    exit();
}

// Atualizar tarefa
if (isset($_POST['method']) && $_POST['method'] == "update") {
    $descricao = $_POST['tarefa'];
    $key = $_POST['key'];
    // Atualizar tarefa do banco de dados pelo ID
    $stmt = $pdo->prepare("UPDATE tarefas SET descricao = ? WHERE id = ?");
    $stmt->execute([$descricao, $key]); // Executa a atualização da tarefa
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Tarefas</title>
    <link rel="stylesheet" href="../style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* Estilos básicos para a modal */
        .modal {
            display: none; /* Inicialmente escondida */
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }
        .modal-content {
            background-color: #fff;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 30%;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <form>
        <input type="text" name="tarefa" id="tarefa" placeholder="Digite sua tarefa...">
        <input type="submit" name="create" class="create" value="Enviar">
    </form>

    <br />
    <h1>Suas tarefas atuais</h1>

    <div id="lista-tarefas">
        <input type="text" name="search-bar" id="search-bar" placeholder="Busque uma tarefa">
        <button id="search-bar-button">Buscar</button>
        <?php 
            // Buscar todas as tarefas do banco de dados
            $stmt = $pdo->query("SELECT * FROM tarefas");
            $tarefas = $stmt->fetchAll(); // Obtém todas as tarefas do banco de dados

            if ($tarefas) {
                foreach ($tarefas as $tarefa) {
                    // Exibe as tarefas com o botão de deletar e atualizar associado ao ID
                    echo "<div>
                            {$tarefa['descricao']}
                            <button class='delete' data-key='{$tarefa['id']}'>Deletar</button>
                            <button class='update' data-key='{$tarefa['id']}' data-descricao='{$tarefa['descricao']}'>Atualizar</button>
                        </div>";
                }
            } else {
                echo "<p>Nenhuma tarefa adicionada.</p>";
            }
        ?>
    </div>

    <!-- Modal para atualizar tarefa -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Atualizar Tarefa</h2>
            <input type="text" id="newTarefa" placeholder="Nova tarefa...">
            <button id="saveUpdate">Atualizar</button>
        </div>
    </div>

    <script>
        $(document).ready(() => {

            var keyToUpdate = null; // Armazenar o ID da tarefa que será atualizada

            function getTasks(search = "") {
                $.ajax({
                        url: '', // Requisição para o mesmo arquivo
                        type: 'GET',
                        data: { method: "read", search }, // Envia o ID da tarefa para deletar
                });
            }

            getTasks();


            // Função para deletar tarefa
            $(document).on('click', '.delete', function() {
                var key = $(this).data('key'); // Pega o ID da tarefa
    
                $.ajax({
                    url: '', // Requisição para o mesmo arquivo
                    type: 'POST',
                    data: { method: "delete", key }, // Envia o ID da tarefa para deletar
                    success: function(response) {
                        location.reload(); // Recarrega a página para atualizar a lista de tarefas
                    },
                    error: function() {
                        alert('Erro ao deletar a tarefa.');
                    }
                });
            });

            // Função para adicionar tarefa
            $(document).on('click', '.create', function(event) {
                event.preventDefault(); // Evita o comportamento padrão do formulário
                var tarefa = $("#tarefa").val(); // Pega o valor digitado no campo de tarefa
    
                $.ajax({
                    url: '', // Requisição para o mesmo arquivo
                    type: 'POST',
                    data: { method: "create", tarefa: tarefa }, // Envia a nova tarefa para criação
                    success: function(response) {
                        location.reload(); // Recarrega a página para atualizar a lista de tarefas
                    },
                    error: function() {
                        alert('Erro ao adicionar a tarefa.');
                    }
                });
            });

            // Abrir modal ao clicar em "Atualizar"
            $(document).on('click', '.update', function() {
                keyToUpdate = $(this).data('key'); // Pega o ID da tarefa
                var descricaoAtual = $(this).data('descricao'); // Pega a descrição atual da tarefa

                $('#newTarefa').val(descricaoAtual); // Preenche o campo com a descrição atual
                $('#myModal').show(); // Exibe a modal
            });

            // Fechar modal
            $('.close').click(function() {
                $('#myModal').hide(); // Esconde a modal
            });

            // Salvar a atualização da tarefa
            $('#saveUpdate').click(function() {
                var novaDescricao = $('#newTarefa').val(); // Pega a nova descrição da tarefa
    
                $.ajax({
                    url: '', // Requisição para o mesmo arquivo
                    type: 'POST',
                    data: { method: "update", tarefa: novaDescricao, key: keyToUpdate }, // Envia a nova descrição e o ID para atualizar
                    success: function(response) {
                        location.reload(); // Recarrega a página para atualizar a lista de tarefas
                    },
                    error: function() {
                        alert('Erro ao atualizar a tarefa.');
                    }
                });

                $('#myModal').hide(); // Esconde a modal após a atualização
            });

            $('#search-bar-button').click(function() {
                var pesquisa = $('#search-bar').val();
                getTasks(pesquisa);
            })
        });
    </script>
</body>
</html>
