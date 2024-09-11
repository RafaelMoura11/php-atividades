<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Usuários</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Gerenciamento de Usuários</h1>

    <!-- Formulário de Cadastro -->
    <h2>Cadastrar Usuário</h2>
    <form id="userForm">
        <label for="nome">Nome:</label><br>
        <input type="text" id="nome" name="nome" required><br><br>

        <label for="idade">Idade:</label><br>
        <input type="number" id="idade" name="idade" required><br><br>

        <button type="submit">Cadastrar</button>
    </form>

    <div id="resultadoCadastro"></div>

    <hr>

    <!-- Exibir Usuários -->
    <h2>Lista de Usuários</h2>
    <input type="text" id="barraPesquisa">
    <button id="buscar">Buscar</button>
    <br />
    <button id="listarUsuarios">Listar Todos</button>
    <div id="resultadoLeitura"></div>

    <hr>

    <!-- Formulário de Atualização -->
    <h2>Atualizar Usuário</h2>
    <form id="updateForm">
        <label for="idUpdate">ID do Usuário:</label><br>
        <input type="number" id="idUpdate" name="id" required><br><br>

        <label for="nomeUpdate">Nome:</label><br>
        <input type="text" id="nomeUpdate" name="nome" required><br><br>

        <label for="idadeUpdate">Idade:</label><br>
        <input type="number" id="idadeUpdate" name="idade" required><br><br>

        <button type="submit">Atualizar</button>
    </form>

    <div id="resultadoAtualizacao"></div>

    <hr>

    <!-- Formulário de Exclusão -->
    <h2>Deletar Usuário</h2>
    <form id="deleteForm">
        <label for="idDelete">ID do Usuário:</label><br>
        <input type="number" id="idDelete" name="id" required><br><br>

        <button type="submit">Deletar</button>
    </form>

    <div id="resultadoExclusao"></div>

    <script>
        // Inserir usuário
        $('#userForm').submit(function(e) {
            e.preventDefault();

            var nome = $('#nome').val();
            var idade = $('#idade').val();

            $.ajax({
                url: 'insert.php',
                type: 'POST',
                data: { nome: nome, idade: idade },
                success: function(response) {
                    $('#resultadoCadastro').html(response);
                    $('#userForm')[0].reset();
                },
                error: function() {
                    $('#resultadoCadastro').html('Erro ao cadastrar usuário.');
                }
            });
        });

        // Listar usuários
        $('#listarUsuarios').click(function() {
            $.ajax({
                url: 'read.php',
                type: 'GET',
                success: function(response) {
                    $('#resultadoLeitura').html(response);
                },
                error: function() {
                    $('#resultadoLeitura').html('Erro ao listar usuários.');
                }
            });
        });

        $('#buscar').click(function() {
            $.ajax({
                url: 'search-user.php',
                data: { nome: $('#barraPesquisa').val() },
                type: 'GET',
                success: function(response) {
                    $('#resultadoLeitura').html(response);
                },
                error: function() {
                    $('#resultadoLeitura').html('Erro ao listar usuários.');
                }
            });
        })

        // Atualizar usuário
        $('#updateForm').submit(function(e) {
            e.preventDefault();

            var id = $('#idUpdate').val();
            var nome = $('#nomeUpdate').val();
            var idade = $('#idadeUpdate').val();

            $.ajax({
                url: 'update.php',
                type: 'POST',
                data: { id: id, nome: nome, idade: idade },
                success: function(response) {
                    $('#resultadoAtualizacao').html(response);
                    $('#updateForm')[0].reset();
                },
                error: function() {
                    $('#resultadoAtualizacao').html('Erro ao atualizar usuário.');
                }
            });
        });

        // Deletar usuário
        $('#deleteForm').submit(function(e) {
            e.preventDefault();

            var id = $('#idDelete').val();

            $.ajax({
                url: 'delete.php',
                type: 'POST',
                data: { id: id },
                success: function(response) {
                    $('#resultadoExclusao').html(response);
                    $('#deleteForm')[0].reset();
                },
                error: function() {
                    $('#resultadoExclusao').html('Erro ao deletar usuário.');
                }
            });
        });
    </script>
</body>
</html>
