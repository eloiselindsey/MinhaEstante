-- banco.sql

-- Cria o banco de dados (se ele ainda não existir)
CREATE DATABASE IF NOT EXISTS minhaestante
DEFAULT CHARACTER SET utf8mb4;

-- Manda o MySQL usar esse banco daqui pra frente
USE minhaestante;

-- Cria a tabela que vai guardar os livros
CREATE TABLE IF NOT EXISTS livros (
    id INT AUTO_INCREMENT PRIMARY KEY,     -- número único de cada livro, gerado automaticamente
    titulo VARCHAR(150) NOT NULL,          -- nome do livro (obrigatório)
    autor VARCHAR(100) NOT NULL,           -- nome do autor (obrigatório)
    nota INT DEFAULT 0,                    -- nota de 0 a 10 dada pelo usuário
    status VARCHAR(20) DEFAULT 'Quero ler' -- Lido, Lendo ou Quero ler
);

-- Insere alguns livros de exemplo para a tabela não ficar vazia no início
INSERT INTO livros (titulo, autor, nota, status) VALUES
('Dom Casmurro', 'Machado de Assis', 9, 'Lido'),
('O Senhor dos Anéis', 'J. R. R. Tolkien', 10, 'Lendo'),
('Vidas Secas', 'Graciliano Ramos', 0, 'Quero ler');
