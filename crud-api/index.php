<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Usuários</title>

    <!-- Importando jQuery via CDN -->
    <link rel="stylesheet" href="../style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h2>Cadastro de Usuário</h2>
    
    <!-- Mensagem de resposta -->
    <div id="response"></div>

    <!-- Formulário -->
    <form id="userForm">
        <input type="hidden" id="id" name="id"> <!-- Campo oculto para edição -->
        <label for="nome">Nome:</label><br>
        <input type="text" id="nome" name="nome" required><br><br>

        <label for="idade">Idade:</label><br>
        <input type="number" id="idade" name="idade" required><br><br>

        <input type="submit" value="Cadastrar">
    </form>

    <h2>Usuários Cadastrados</h2>
    <div id="userList"></div>

    <script>
        $(document).ready(function() {
            // Função para carregar a lista de usuários
            function loadUsers() {
                $.ajax({
                    url: "crud.php?action=read",
                    type: "GET",
                    success: function(data) {
                        $('#userList').html(data);
                    }
                });
            }

            // Carrega a lista de usuários ao carregar a página
            loadUsers();

            // Intercepta o envio do formulário
            $("#userForm").submit(function(e) {
                e.preventDefault(); // Impede o comportamento padrão

                // Serializa os dados do formulário
                var formData = $(this).serialize();

                // Envia os dados via AJAX
                $.ajax({
                    type: "POST",
                    url: "crud.php?action=create",
                    data: formData,
                    success: function(response) {
                        $("#response").html(response);
                        $("#userForm")[0].reset(); // Limpa o formulário
                        loadUsers(); // Atualiza a lista de usuários
                    }
                });
            });

            // Função para editar um usuário
            $(document).on('click', '.editUser', function() {
                var id = $(this).data('id');
                var nome = $(this).data('nome');
                var idade = $(this).data('idade');

                $('#id').val(id);
                $('#nome').val(nome);
                $('#idade').val(idade);
                $('input[type=submit]').val('Atualizar');
            });

            // Função para excluir um usuário
            $(document).on('click', '.deleteUser', function() {
                var id = $(this).data('id');
                $.ajax({
                    url: "crud.php?action=delete&id=" + id,
                    type: "GET",
                    success: function(response) {
                        $("#response").html(response);
                        loadUsers();
                    }
                });
            });
        });
    </script>
</body>
</html>
