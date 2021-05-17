CREATE TABLE TipoEvento(
	id_tipo serial NOT NULL,
	nombre varchar(30),
	PRIMARY KEY (id_tipo)
);
CREATE TABLE Eventos(
	id_evento serial NOT NULL,
	id_tipo integer NOT NULL,
	frecuencia char(1),
	titulo_evento varchar(40),
	descripcion varchar(50),
	fecha_inicio date,
	fecha_fin date,
	hora time,
	PRIMARY KEY (id_evento),
	FOREIGN KEY (id_tipo) REFERENCES TipoEvento ON DELETE NO ACTION,
	CHECK (frecuencia IN('U','D','S','M','A','O'))
);
-- U una sola vez
-- D diario
-- S semanal
-- M mensual
-- A anual
-- O días alternos