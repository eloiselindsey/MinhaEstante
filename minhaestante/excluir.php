<?php
// excluir.php - apaga um livro do banco

include "conexao.php";

// Verifica se veio um id pela URL (excluir.php?id=5)
if (isset($_GET['id'])) {

    $id = $_GET['id'];

    // O WHERE id = ? garante que só o livro escolhido será apagado.
    // ATENÇÃO: sem o WHERE, o comando apagaria a tabela inteira!
    $sql = "DELETE FROM livros WHERE id = ?";

    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, "i", $id);
    mysqli_stmt_execute($comando);
}

// Depois de apagar, volta para a lista com a mensagem de sucesso
header("Location: livros.php?msg=excluido");
exit;
?>
