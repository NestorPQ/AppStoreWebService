
###############  LISTAR PRODUCTO POR ID  ###############
DELIMITER $$
CREATE PROCEDURE sp_prosductos_buscar(IN id_producto INT)
BEGIN
	SELECT 
		p.idproducto,
		c.categoria AS categoria,
		p.descripcion,
		p.precio,
		p.garantia,
		p.fotografia
	FROM productos p
	INNER JOIN categorias c ON p.idcategoria = c.idcategoria
	WHERE p.idproducto = id_producto;
	END $$
DELIMITER ;


CALL sp_prosductos_buscar(1);

###############  LISTANDO TODOS LOS PRODUCTOS  ###############
DELIMITER $$
CREATE PROCEDURE sp_listar_productos()
BEGIN
  SELECT 
		p.idproducto,
		c.categoria AS categoria,
		p.descripcion,
		p.precio,
		p.garantia,
		p.fotografia
	FROM productos p
	INNER JOIN categorias c ON p.idcategoria = c.idcategoria
		WHERE p.inactive_at IS NULL;
	END $$
DELIMITER ;

CALL sp_listar_productos();


###############  SP PARA REGISTRAR PRODUCTO  ###############
DELIMITER $$
CREATE PROCEDURE spu_productos_registrar
(
	IN _idcategoria INT,
	IN _descripcion VARCHAR(100),
	IN _precio FLOAT(5,2),
	IN _garantia INT(2),
	IN _fotografia VARCHAR(100)
)
BEGIN
	INSERT INTO productos
		(idcategoria, descripcion, precio,garantia, fotografia)
		VALUES
		(_idcategoria, _descripcion, _precio, _garantia, NULLIF(_fotografia, ' '));
END $$

-- Llama al procedimiento almacenado para insertar un producto
CALL spu_productos_registrar(1, 'Teléfono móvil', 499.99, 12, 'telefono.jpg');
CALL spu_productos_registrar(2, 'Camiseta', 19.99, 0, 'camiseta.jpg');
CALL spu_productos_registrar(3, 'Sofá', 799.99, 36, 'sofa.jpg');
CALL spu_productos_registrar(4, 'Pelota de fútbol', 9.99, 0, 'pelota.jpg');
CALL spu_productos_registrar(5, 'Raqueta de tenis', 49.99, 0, 'raqueta.jpg');



###############  SP PARA ELIMINAR Y ACTUALIZAR CATEGORIA  ###############
DELIMITER $$
CREATE PROCEDURE sp_actualizar_categoria(IN _idcategoria INT, IN _nueva_categoria VARCHAR(50))
BEGIN
    UPDATE categorias SET categoria = _nueva_categoria WHERE idcategoria = _idcategoria;
END $$
DELIMITER ;

CALL sp_actualizar_categoria(7, 'Nueva Categoría'); -- Donde 1 es el id de la categoría que deseas actualizar y 'Nueva Categoría' es el nuevo nombre de la categoría.


DELIMITER $$
CREATE PROCEDURE sp_eliminar_categoria(IN _idcategoria INT)
BEGIN
    DELETE FROM categorias WHERE idcategoria = _idcategoria;
END $$
DELIMITER ;

CALL sp_eliminar_categoria(6); -- Donde 1 es el id de la categoría que deseas eliminar.

DELIMITER $$
CREATE PROCEDURE sp_agregar_categoria(IN _nombre_categoria VARCHAR(50))
BEGIN
    INSERT INTO categorias (categoria)
    VALUES (_nombre_categoria);
END $$
DELIMITER ;

CALL sp_agregar_categoria('Categoria'); 

DELIMITER $$
CREATE PROCEDURE sp_listar_categoria()
BEGIN
    SELECT categoria
    FROM categorias;
END $$
DELIMITER ;

SELECT * FROM categorias;

CALL sp_listar_categoria();
