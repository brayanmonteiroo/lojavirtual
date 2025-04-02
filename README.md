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
```