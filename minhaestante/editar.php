<?php
// editar.php - altera os dados de um livro que já existe

include "conexao.php";

// PARTE 1: quando o usuário clica em "Salvar alterações"
if (isset($_POST['atualizar'])) {

    $id     = $_POST['id'];      // id escondido no formulário
    $titulo = $_POST['titulo'];
    $autor  = $_POST['autor'];
    $nota   = $_POST['nota'];
    $status = $_POST['status'];

    // O WHERE id = ? garante que só UM livro será alterado
    $sql = "UPDATE livros SET titulo = ?, autor = ?, nota = ?, status = ? WHERE id = ?";

    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, "ssisi", $titulo, $autor, $nota, $status, $id);
    mysqli_stmt_execute($comando);

    header("Location: livros.php?msg=editado");
    exit;
}

// PARTE 2: quando a página abre, precisamos buscar os dados atuais do livro
// para já mostrá-los preenchidos no formulário.

// Verifica se veio um id pela URL (editar.php?id=5)
if (!isset($_GET['id'])) {
    header("Location: livros.php"); // se não veio, volta para a lista
    exit;
}

$id = $_GET['id'];

$sql = "SELECT * FROM livros WHERE id = ?";
$comando = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($comando, "i", $id); // "i" = o id é um número inteiro
mysqli_stmt_execute($comando);

// Pega o resultado da busca
$resultado = mysqli_stmt_get_result($comando);

// Transforma a linha encontrada em um array chamado $livro
$livro = mysqli_fetch_assoc($resultado);

// Se não achou nenhum livro com esse id, volta para a lista
if (!$livro) {
    header("Location: livros.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MinhaEstante - Editar livro</title>
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
            <h1>Editar livro</h1>

            <form method="post" action="editar.php">

                <!-- Campo escondido: leva o id junto, mas o usuário não vê -->
                <input type="hidden" name="id" value="<?php echo $livro['id']; ?>">

                <label for="titulo">Título:</label>
                <!-- O value já vem preenchido com o que está salvo no banco -->
                <input type="text" id="titulo" name="titulo"
                       value="<?php echo htmlspecialchars($livro['titulo']); ?>" required>

                <label for="autor">Autor:</label>
                <input type="text" id="autor" name="autor"
                       value="<?php echo htmlspecialchars($livro['autor']); ?>" required>

                <label for="nota">Nota (0 a 10):</label>
                <input type="number" id="nota" name="nota" min="0" max="10"
                       value="<?php echo $livro['nota']; ?>">

                <label for="status">Status:</label>
                <select id="status" name="status">
                    <!-- O "selected" marca a opção que já está salva no banco -->
                    <option value="Quero ler" <?php if ($livro['status'] == "Quero ler") echo "selected"; ?>>Quero ler</option>
                    <option value="Lendo"     <?php if ($livro['status'] == "Lendo")     echo "selected"; ?>>Lendo</option>
                    <option value="Lido"      <?php if ($livro['status'] == "Lido")      echo "selected"; ?>>Lido</option>
                </select>

                <button type="submit" name="atualizar" class="botao">Salvar alterações</button>
            </form>

            <p style="margin-top:15px"><a href="livros.php">&larr; Voltar para a lista</a></p>
        </section>
    </main>

    <footer>
        <p>MinhaEstante &copy; 2026 - Projeto acadêmico AV2</p>
    </footer>

</body>
</html>
