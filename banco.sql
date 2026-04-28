
CREATE DATABASE focusflow;


CREATE TABLE usuarios (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE tarefas (
    id SERIAL PRIMARY KEY,
    usuario_id INTEGER NOT NULL REFERENCES usuarios(id) ON DELETE CASCADE,
    titulo VARCHAR(200) NOT NULL,
    descricao TEXT,
    data_vencimento DATE,
    prioridade VARCHAR(20) DEFAULT 'normal', -- normal | importante | urgente
    concluida BOOLEAN DEFAULT FALSE,
    criada_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE subtarefas (
    id SERIAL PRIMARY KEY,
    tarefa_id INTEGER NOT NULL REFERENCES tarefas(id) ON DELETE CASCADE,
    titulo VARCHAR(200) NOT NULL,
    concluida BOOLEAN DEFAULT FALSE,
    criada_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE tags (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(100) UNIQUE NOT NULL
);


CREATE TABLE tarefa_tags (
    tarefa_id INTEGER NOT NULL REFERENCES tarefas(id) ON DELETE CASCADE,
    tag_id INTEGER NOT NULL REFERENCES tags(id) ON DELETE CASCADE,
    PRIMARY KEY (tarefa_id, tag_id)
);


INSERT INTO usuarios (nome, email, senha)
VALUES ('Gabriel Braga', 'gabriel@email.com', 'senha_hash_aqui');

INSERT INTO tarefas (usuario_id, titulo, descricao, prioridade)
VALUES (1, 'Entregar projeto de front-end', 'Finalizar o site To-Do', 'urgente');

INSERT INTO subtarefas (tarefa_id, titulo)
VALUES 
(1, 'Definir estrutura HTML'),
(1, 'Estilizar com CSS'),
(1, 'Implementar interatividade com JavaScript');

INSERT INTO tags (nome) 
VALUES ('Faculdade'), ('Pessoal');

INSERT INTO tarefa_tags (tarefa_id, tag_id) 
VALUES (1, 1);