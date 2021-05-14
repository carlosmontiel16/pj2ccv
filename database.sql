CREATE TABLE TipoEvento(
	id_tipo serial,
	nombre char(30),
	PRIMARY KEY (id_tipo)
);
CREATE TABLE Eventos(
	id_evento serial,
	id_tipo integer NOT NULL,
	frecuencia char(1),
	titulo_evento char(40),
	descripcion char(50),
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
INSERT INTO TipoEvento(nombre) VALUES ('Cumple');
insert into Eventos(id_tipo, frecuencia, titulo_Evento, descripcion, fecha_inicio, fecha_fin, hora) VALUES(1,'A','Cumpleaños Sobrina','Cumpleaños Emely, almuerzo','04-05-2021','04-05-2021','12:30:00');
select * from TipoEvento;
select * from Eventos;