# lojavirtual
 
## Criação das tabelas no banco de dados

```mysql
CREATE TABLE usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    cpf VARCHAR(14) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    nascimento DATE NOT NULL,
    ativo BOOLEAN DEFAULT TRUE,
    cadastrado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE categoria (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT,
    status ENUM('ativo', 'inativo') DEFAULT 'ativo',
    visitas INT DEFAULT 0,
    cadastrado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE produto (
    id INT AUTO_INCREMENT PRIMARY KEY,
    categoria_id INT NOT NULL,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT,
    preco DECIMAL(10,2) NOT NULL,
    estoque INT NOT NULL,
    status ENUM('disponivel', 'indisponivel') DEFAULT 'disponivel',
    cadastrado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    atualizado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    ultima_visita_em TIMESTAMP NULL DEFAULT NULL,
    visitas INT DEFAULT 0,
    FOREIGN KEY (categoria_id) REFERENCES categoria(id)
);

CREATE TABLE endereco (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    tipo ENUM('residencial', 'comercial') NOT NULL,
    cep VARCHAR(10) NOT NULL,
    logradouro VARCHAR(255) NOT NULL,
    numero VARCHAR(10) NOT NULL,
    complemento VARCHAR(255) NULL,
    bairro VARCHAR(100) NOT NULL,
    cidade VARCHAR(100) NOT NULL,
    estado VARCHAR(50) NOT NULL,
    cadastrado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    atualizado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuario(id)
);

CREATE TABLE venda (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    endereco_id INT NOT NULL,
    total DECIMAL(10,2) NOT NULL,
    forma_pagamento ENUM('cartao', 'boleto', 'pix') NOT NULL,
    status_pagamento ENUM('pendente', 'pago', 'cancelado') DEFAULT 'pendente',
    status_venda ENUM('processando', 'enviado', 'entregue', 'cancelado') DEFAULT 'processando',
    data_venda TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuario(id),
    FOREIGN KEY (endereco_id) REFERENCES endereco(id)
);

CREATE TABLE item_venda (
    id INT AUTO_INCREMENT PRIMARY KEY,
    venda_id INT NOT NULL,
    produto_id INT NOT NULL,
    quantidade INT NOT NULL,
    preco_unitario DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (venda_id) REFERENCES venda(id),
    FOREIGN KEY (produto_id) REFERENCES produto(id)
);

CREATE TABLE carrinho (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    produto_id INT NOT NULL,
    quantidade INT NOT NULL DEFAULT 1,
    adicionado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuario(id),
    FOREIGN KEY (produto_id) REFERENCES produto(id)
);

-- Índices para otimização
CREATE INDEX idx_produto_categoria ON produto(categoria_id);
CREATE INDEX idx_endereco_usuario ON endereco(usuario_id);
CREATE INDEX idx_venda_usuario ON venda(usuario_id);
CREATE INDEX idx_item_venda_venda ON item_venda(venda_id);
CREATE INDEX idx_item_venda_produto ON item_venda(produto_id);
CREATE INDEX idx_carrinho_usuario ON carrinho(usuario_id);
CREATE INDEX idx_carrinho_produto ON carrinho(produto_id);

-- Inserção de dados
INSERT INTO usuario (nome, cpf, email, senha, nascimento, ativo) VALUES
('João Silva', '123.456.789-01', 'joao@email.com', 'senha123', '1990-05-15', TRUE),
('Maria Oliveira', '987.654.321-00', 'maria@email.com', 'senha456', '1992-08-22', TRUE),
('Carlos Souza', '111.222.333-44', 'carlos@email.com', 'senha789', '1985-03-10', TRUE),
('Ana Lima', '555.666.777-88', 'ana@email.com', 'senha000', '1998-12-01', TRUE),
('Pedro Rocha', '999.888.777-66', 'pedro@email.com', 'senhaabc', '1991-07-30', TRUE);

INSERT INTO categoria (nome, descricao, status) VALUES
('Eletrônicos', 'Produtos eletrônicos em geral', 'ativo'),
('Roupas', 'Vestimentas masculinas e femininas', 'ativo'),
('Calçados', 'Sapatos, tênis e botas', 'ativo'),
('Acessórios', 'Relógios, cintos e bolsas', 'ativo'),
('Esporte', 'Equipamentos e roupas esportivas', 'ativo');

INSERT INTO produto (categoria_id, nome, descricao, preco, estoque, status) VALUES
(1, 'Smartphone', 'Smartphone topo de linha', 2999.99, 50, 'disponivel'),
(2, 'Camiseta', 'Camiseta 100% algodão', 49.99, 200, 'disponivel'),
(3, 'Tênis Esportivo', 'Tênis de corrida', 199.99, 80, 'disponivel'),
(4, 'Relógio de Pulso', 'Relógio analógico masculino', 129.99, 60, 'disponivel'),
(5, 'Mochila', 'Mochila resistente para viagem', 259.99, 40, 'disponivel');

INSERT INTO endereco (usuario_id, tipo, cep, logradouro, numero, complemento, bairro, cidade, estado) VALUES
(1, 'residencial', '01001-000', 'Rua A', '123', 'Apto 101', 'Centro', 'São Paulo', 'SP'),
(2, 'comercial', '02002-000', 'Av. B', '456', NULL, 'Bairro B', 'Rio de Janeiro', 'RJ');

INSERT INTO venda (usuario_id, endereco_id, total, forma_pagamento, status_pagamento, status_venda) VALUES
(1, 1, 2999.99, 'cartao', 'pago', 'processando'),
(2, 2, 49.99, 'pix', 'pendente', 'processando');

INSERT INTO item_venda (venda_id, produto_id, quantidade, preco_unitario) VALUES
(1, 1, 1, 2999.99),
(2, 2, 1, 49.99);

INSERT INTO carrinho (usuario_id, produto_id, quantidade) VALUES
(1, 2, 2),
(2, 1, 1),
(3, 3, 1),
(4, 4, 1),
(5, 5, 1);
```