<?php
// cadastrar.php - formulário para adicionar um livro novo

include "conexao.php";

// Este "if" só é verdadeiro quando o usuário CLICOU no botão Salvar.
// Na primeira vez que a página abre, ele é falso e só o formulário aparece.
if (isset($_POST['salvar'])) {

    // Pega os dados que vieram do formulário
    $titulo = $_POST['titulo'];
    $autor  = $_POST['autor'];
    $nota   = $_POST['nota'];
    $status = $_POST['status'];

    // Monta o comando de inserção.
    // Os "?" são espaços reservados: protegem o banco contra invasão (SQL Injection).
    $sql = "INSERT INTO livros (titulo, autor, nota, status) VALUES (?, ?, ?, ?)";

    // Prepara o comando no banco
    $comando = mysqli_prepare($conexao, $sql);

    // Coloca os valores no lugar dos "?".
    // "ssis" indica o tipo de cada valor: s = texto (string), i = número inteiro
    mysqli_stmt_bind_param($comando, "ssis", $titulo, $autor, $nota, $status);

    // Executa o comando de verdade
    mysqli_stmt_execute($comando);

    // Manda o usuário de volta para a lista, com uma mensagem de sucesso
    header("Location: livros.php?msg=cadastrado");
    exit; // para a execução do script aqui
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MinhaEstante - Cadastrar livro</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <header>
        <div class="logo">📚 MinhaEstante</div>
        <nav>
            <a href="index.html">Início</a>
            <a href="livros.php">Minha Estante</a>
            <a href="sobre.html">Sobre</a>
            <a href="contato.html">Contato</a>
        </nav>
    </header>

    <main>
        <section class="caixa">
            <h1>Cadastrar novo livro</h1>

            <!-- method="post" envia os dados de forma escondida (não aparecem na URL) -->
            <!-- action="cadastrar.php" manda os dados para esta mesma página -->
            <form method="post" action="cadastrar.php">

                <label for="titulo">Título:</label>
                <!-- "required" faz o navegador exigir o preenchimento -->
                <input type="text" id="titulo" name="titulo" required>

                <label for="autor">Autor:</label>
                <input type="text" id="autor" name="autor" required>

                <label for="nota">Nota (0 a 10):</label>
                <input type="number" id="nota" name="nota" min="0" max="10" value="0">

                <label for="status">Status:</label>
                <select id="status" name="status">
                    <option value="Quero ler">Quero ler</option>
                    <option value="Lendo">Lendo</option>
                    <option value="Lido">Lido</option>
                </select>

                <!-- O name="salvar" é o que o PHP verifica lá em cima no isset() -->
                <button type="submit" name="salvar" class="botao">Salvar</button>
            </form>

            <p style="margin-top:15px"><a href="livros.php">&larr; Voltar para a lista</a></p>
        </section>
    </main>

    <footer>
        <p>MinhaEstante &copy; 2026 - Projeto acadêmico AV2</p>
    </footer>

</body>
</html>
