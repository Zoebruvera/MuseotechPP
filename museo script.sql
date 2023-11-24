DROP DATABASE IF EXISTS museo;
CREATE DATABASE IF NOT EXISTS museo;

USE museo;

CREATE TABLE seccion(
	id_seccion INT,
    seccNombre VARCHAR(50),
    PRIMARY KEY (id_seccion)
);

CREATE INDEX idx_seccion_seccNombre ON seccion(id_seccion);
CREATE TABLE vitrina(
	fotoVitrina VARCHAR(255),
    id_vitrina INT,
    seccionAlojada VARCHAR(50),
    PRIMARY KEY (id_vitrina),
    FOREIGN KEY (seccionAlojada) REFERENCES seccion(id_seccion) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE objeto(
	fotoObjeto VARCHAR(255),
    id_inventario INT,
    Nombre_obj VARCHAR(50),
    Clasificación VARCHAR(50),
    Descripción VARCHAR(255),
    Fecha_alta DATE,
    Fecha_baja DATE DEFAULT NULL,
    SecciónNombre VARCHAR(50),
    SecciónVitrina INT,
    PRIMARY KEY(id_inventario),
    FOREIGN KEY(SecciónNombre) REFERENCES seccion(id_seccion) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY(SecciónVitrina) REFERENCES vitrina(id_vitrina) ON UPDATE CASCADE ON DELETE CASCADE
);

/*Tabla específica para registrar cuándo un objeto se desplazó*/
CREATE TABLE historial(
	id_cambio INT AUTO_INCREMENT,
    Campo VARCHAR(50),
    id_objeto INT,
    NombreAnt VARCHAR(50),
    ValorAnt VARCHAR(255),
    ValorNuevo VARCHAR(255),
    AñadidoPor VARCHAR(50) NOT NULL DEFAULT (USER( )),
    AñadidoFecha TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(id_cambio)
);

/*Cuando se cambia de sección una vitrina, se cambia de sección el objeto alojado en esa vitrina*/
DELIMITER $$
CREATE TRIGGER histCambioVitrinaLugar_update AFTER UPDATE ON vitrina
FOR EACH ROW BEGIN
	IF !(OLD.seccionAlojada = NEW.seccionAlojada) THEN
        UPDATE objeto SET SecciónNombre = NEW.seccionAlojada WHERE SecciónVitrina = NEW.id_vitrina;
    END IF;
END$$

CREATE TRIGGER seccionEliminada_delete BEFORE DELETE ON seccion
FOR EACH ROW BEGIN
	INSERT INTO historial(Campo, id_objeto, NombreAnt, ValorAnt, ValorNuevo)
    SELECT 'Fila completa', id_inventario, Nombre_obj, 'Objeto existente', 'Objeto removido'
    FROM objeto
    WHERE SecciónNombre = OLD.id_seccion;
END$$

/*Cuando se elimina una vitrina, se deberían eliminar todos los objetos de esa vitrina*/
CREATE TRIGGER vitrinaEliminada_delete BEFORE DELETE ON vitrina
FOR EACH ROW BEGIN
	INSERT INTO historial(Campo, id_objeto, NombreAnt, ValorAnt, ValorNuevo)
    SELECT 'Fila completa', id_inventario, Nombre_obj, 'Objeto existente', 'Objeto removido'
    FROM objeto
    WHERE SecciónVitrina = OLD.id_vitrina;
END$$

/*Trigger para guardar los datos de un objeto que se movió, siendo por darlo de baja, cambiarlo de sección o vitrina*/
CREATE TRIGGER histCambio_update AFTER UPDATE ON objeto
FOR EACH ROW BEGIN 
    IF !(OLD.Fecha_alta = NEW.Fecha_alta) THEN 
		INSERT INTO historial(Campo, id_objeto, NombreAnt, ValorAnt, ValorNuevo) VALUES('Fecha_alta', OLD.id_inventario, OLD.Nombre_obj, OLD.Fecha_alta, NEW.Fecha_alta);
	END IF;
    IF !(OLD.Fecha_baja = NEW.Fecha_baja) THEN 
		INSERT INTO historial(Campo, id_objeto, NombreAnt, ValorAnt, ValorNuevo) VALUES('Fecha_baja', OLD.id_inventario, OLD.Nombre_obj, OLD.Fecha_baja, NEW.Fecha_baja);
	END IF;
    IF !(OLD.SecciónNombre = NEW.SecciónNombre) THEN 
		INSERT INTO historial(Campo, id_objeto, NombreAnt, ValorAnt, ValorNuevo) VALUES('SecciónNombre', OLD.id_inventario, OLD.Nombre_obj, OLD.SecciónNombre, NEW.SecciónNombre);
	END IF;
    IF !(OLD.SecciónVitrina = NEW.SecciónVitrina) THEN 
		INSERT INTO historial(Campo, id_objeto, NombreAnt, ValorAnt, ValorNuevo) VALUES('SecciónVitrina', OLD.id_inventario, OLD.Nombre_obj, OLD.SecciónVitrina, NEW.SecciónVitrina);
	END IF;
END$$

/*Trigger para registrar cuando un objeto fue removido del inventario*/
CREATE TRIGGER histCambio_delete AFTER DELETE ON objeto
FOR EACH ROW BEGIN
	INSERT INTO historial(Campo, id_objeto, NombreAnt, ValorAnt, ValorNuevo) VALUES('Fila completa', OLD.id_inventario, OLD.Nombre_obj, 'Objeto existente', 'Objeto removido');
END$$
DELIMITER ;