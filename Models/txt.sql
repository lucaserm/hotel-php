-- Criação da tabela clientes
CREATE TABLE clientes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(255),
  email VARCHAR(255),
  senha VARCHAR(255)
  tel VARCHAR(20),
);

-- Criação da tabela quartos
CREATE TABLE quartos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  numero INT,
  tipo_quarto ENUM('standart', 'deluxe', 'suite'),
  preco DECIMAL(10, 2)
);

INSERT INTO quartos (numero, preco) VALUES (2, 99.9);

-- Criação da tabela reservas
CREATE TABLE reservas (
  id INT AUTO_INCREMENT PRIMARY KEY,
  id_cliente INT,
  id_quarto INT,
  data_chegada DATE,
  data_saida DATE,
  num_hospedes INT,
  preco_total DECIMAL(10, 2),
  status VARCHAR(255),
  FOREIGN KEY (id_cliente) REFERENCES clientes(id),
  FOREIGN KEY (id_quarto) REFERENCES quartos(id)
);

INSERT INTO reservas (id, id_cliente, id_quarto, data_chegada, data_saida, num_hospedes, preco_total) VALUES (default, 1, 1, NOW(), NOW(), 2, 99.9);
DROP TABLE reservas;
DROP TABLE quartos;
DROP TABLE clientes;