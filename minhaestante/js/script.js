// js/script.js

// Procura na página o formulário que tem id="formContato"
var formulario = document.getElementById("formContato");

// O "if" evita erro caso o arquivo seja carregado numa página sem formulário
if (formulario) {

    // "addEventListener" fica escutando o evento de envio (submit) do formulário
    formulario.addEventListener("submit", function (evento) {

        // Impede que a página recarregue ao enviar o formulário
        evento.preventDefault();

        // Pega o que o usuário digitou em cada campo.
        // O ".value" pega o texto e o ".trim()" remove os espaços do começo e do fim
        var nome = document.getElementById("nome").value.trim();
        var email = document.getElementById("email").value.trim();
        var mensagem = document.getElementById("mensagem").value.trim();

        // Verifica se o campo nome ficou vazio
        if (nome === "") {
            alert("Por favor, preencha o seu nome.");
            return; // "return" para a função aqui e não executa o resto
        }

        // Verifica se o campo e-mail ficou vazio
        if (email === "") {
            alert("Por favor, preencha o seu e-mail.");
            return;
        }

        // Verificação simples de e-mail: precisa ter o caractere "@"
        if (email.indexOf("@") === -1) {
            alert("Digite um e-mail válido (precisa conter @).");
            return;
        }

        // Verifica se a mensagem ficou vazia
        if (mensagem === "") {
            alert("Por favor, escreva a sua mensagem.");
            return;
        }

        // Se chegou até aqui, é porque está tudo preenchido
        alert("Obrigado, " + nome + "! Sua mensagem foi enviada com sucesso.");

        // Limpa todos os campos do formulário
        formulario.reset();
    });
}
