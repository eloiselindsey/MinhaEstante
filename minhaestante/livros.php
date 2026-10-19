<?php
// livros.php - mostra todos os livros cadastrados

// Inclui o arquivo de conexão. Sem isso, a variável $conexao não existiria aqui.
include "conexao.php";

// Monta o comando SQL que busca todos os livros, ordenados pelo título
$sql = "SELECT * FROM livros ORDER BY titulo ASC";

// Executa o comando no banco e guarda o resultado
$resultado = mysqli_query($conexao, $sql);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MinhaEstante - Meus livros</title>
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
            <h1>Minha Estante</h1>
            <a href="cadastrar.php" class="botao">+ Cadastrar novo livro</a>

            <?php
            // Verifica se veio alguma mensagem pela URL (ex: livros.php?msg=cadastrado)
            if (isset($_GET['msg'])) {
                if ($_GET['msg'] == "cadastrado") {
                    echo "<p style='color:green'>Livro cadastrado com sucesso!</p>";
                }
                if ($_GET['msg'] == "editado") {
                    echo "<p style='color:green'>Livro atualizado com sucesso!</p>";
                }
                if ($_GET['msg'] == "excluido") {
                    echo "<p style='color:green'>Livro excluído com sucesso!</p>";
                }
            }
            ?>

            <table>
                <tr>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Nota</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>

                <?php
                // Verifica se o banco retornou pelo menos 1 linha
                if (mysqli_num_rows($resultado) > 0) {

                    // O "while" repete o bloco abaixo uma vez para CADA livro encontrado.
                    // A cada volta, $linha recebe os dados de um livro diferente.
                    while ($linha = mysqli_fetch_assoc($resultado)) {
                        echo "<tr>";

                        // htmlspecialchars protege o site caso o usuário digite código HTML
                        echo "<td>" . htmlspecialchars($linha['titulo']) . "</td>";
                        echo "<td>" . htmlspecialchars($linha['autor']) . "</td>";
                        echo "<td>" . $linha['nota'] . "/10</td>";
                        echo "<td>" . htmlspecialchars($linha['status']) . "</td>";

                        // Nos links abaixo enviamos o id do livro pela URL (?id=...)
                        echo "<td>
                                <a href='editar.php?id=" . $linha['id'] . "'>Editar</a> |
                                <a href='excluir.php?id=" . $linha['id'] . "'
                                   onclick='return confirm(\"Tem certeza que deseja excluir?\")'>Excluir</a>
                              </td>";

                        echo "</tr>";
                    }

                } else {
                    // Se não houver nenhum livro, mostra uma linha avisando
                    echo "<tr><td colspan='5'>Nenhum livro cadastrado ainda.</td></tr>";
                }
                ?>
            </table>
        </section>
    </main>

    <footer>
        <p>MinhaEstante &copy; 2026 - Projeto acadêmico AV2</p>
    </footer>

</body>
</html>
