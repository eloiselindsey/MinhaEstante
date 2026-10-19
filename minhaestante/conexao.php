<?php
// conexao.php
// Este arquivo só serve para abrir a conexão com o banco.
// Todas as outras páginas PHP vão "incluir" ele no topo.

$servidor = "localhost";      // no XAMPP o servidor é sempre localhost
$usuario  = "root";           // usuário padrão do MySQL no XAMPP
$senha    = "";               // no XAMPP a senha vem vazia por padrão
$banco    = "minhaestante";   // nome do banco que criamos no script SQL

// Tenta conectar. Se der certo, guarda a conexão na variável $conexao
$conexao = mysqli_connect($servidor, $usuario, $senha, $banco);

// Se a conexão falhar, o site para aqui e mostra o motivo do erro
if (!$conexao) {
    die("Erro ao conectar no banco de dados: " . mysqli_connect_error());
}

// Garante que os acentos apareçam corretamente
mysqli_set_charset($conexao, "utf8mb4");
?>
