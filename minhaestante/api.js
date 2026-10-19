
async function buscarLivros() {
  const titulo = document.getElementById("tituloLivro").value.trim();
  const resultados = document.getElementById("resultados");
  const mensagem = document.getElementById("mensagem");

  resultados.innerHTML = "";
  mensagem.textContent = "";

  if (!titulo) {
    mensagem.textContent = "Digite o nome de um livro!";
    return;
  }

  try {
    mensagem.textContent = "Buscando livros...";

    const resposta = await fetch(
      `https://openlibrary.org/search.json?title=${encodeURIComponent(titulo)}&limit=6`
    );

    if (!resposta.ok) {
      throw new Error("Erro na requisição");
    }

    const dados = await resposta.json();

    if (dados.docs.length === 0) {
      mensagem.textContent = "Nenhum livro encontrado.";
      return;
    }

    mensagem.textContent = "";

    dados.docs.forEach(livro => {
      const card = document.createElement("div");
      card.classList.add("card-livro");

      const nome = document.createElement("h3");
      nome.textContent = livro.title;

      const autor = document.createElement("p");
      autor.textContent = "Autor: " +
        (livro.author_name?.[0] || "Desconhecido");

      card.appendChild(nome);
      card.appendChild(autor);
      resultados.appendChild(card);
    });

  } catch (erro) {
    mensagem.textContent =
      "Não foi possível buscar os livros. Tente novamente!";
    console.error(erro);
  }
}
