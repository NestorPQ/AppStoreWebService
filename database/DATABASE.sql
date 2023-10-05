
###############  1 CREACION DE LA BASE DE DATOS  ###############
CREATE DATABASE appstore;

USE appstore;

###############  2 CREACION DE LAS TABLAS  ###############
CREATE TABLE categorias (
	idcategoria	 INT 				AUTO_INCREMENT,
	categoria		 VARCHAR(50) 		NOT NULL,
	create_at		 DATETIME			DEFAULT NOW(),
	update_at	 DATETIME 			NULL,
	inactive_at 	DATETIME			NULL,
	CONSTRAINT pk_idcategoria PRIMARY KEY(idcategoria)
)ENGINE = INNODB;

INSERT INTO categorias (categoria) VALUES
('Electrónica'),
('Ropa'),
('Muebles'),
('Juguetes'),
('Deportes'),
('Hogar'),
('Alimentos'),
('Bebidas'),
('Libros'),
('Automóviles');



CREATE TABLE productos (
	idproducto 	INT 				AUTO_INCREMENT,
	idcategoria 	INT,
	descripcion 	VARCHAR(100)	 NOT NULL,
	precio		FLOAT(5,2)		 NOT NULL,
	garantia 		INT(2) 			 NOT NULL , 
	fotografia 	VARCHAR(100)	 NULL,
	create_at		DATETIME		 DEFAULT NOW(),
	update_at	DATETIME                NULL,
	inactive_at	DATETIME 		  NULL,
	CONSTRAINT pk_idproducto PRIMARY KEY(idproducto),
	CONSTRAINT fk_idcategoria FOREIGN KEY (idcategoria) REFERENCES categorias(idcategoria)
)ENGINE = INNODB;

INSERT INTO productos (idcategoria, descripcion, precio, garantia, fotografia) VALUES
(1, 'Teléfono móvil', 499.99, 12, 'telefono.jpg'),
(1, 'Laptop', 899.99, 24, 'laptop.jpg'),
(2, 'Camiseta', 19.99, 0, 'camiseta.jpg'),
(2, 'Pantalones', 39.99, 0, 'pantalones.jpg'),
(3, 'Sofá', 799.99, 36, 'sofa.jpg'),
(3, 'Mesa de centro', 129.99, 24, 'mesa.jpg'),
(4, 'Pelota de fútbol', 9.99, 0, 'pelota.jpg'),
(4, 'Muñeca', 14.99, 0, 'muneca.jpg'),
(5, 'Raqueta de tenis', 49.99, 0, 'raqueta.jpg'),
(5, 'Balón de baloncesto', 19.99, 0, 'balon.jpg');
