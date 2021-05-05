CREATE TABLE TipoEvento(
	id_tipo integer,
	nombre char(30),
	PRIMARY KEY (id_tipo)
);
CREATE TABLE Eventos(
	id_evento integer,
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

INSERT INTO TipoEvento VALUES (5,'Pago');
INSERT INTO Eventos VALUES (1,1,'A','Cumpleaños Sobrina','Cumpleaños Emely, almuerzo','04-05-2021','04-05-2021','12:30:00');
INSERT INTO Eventos VALUES (2,3,'A','Feria de Jocotenango','Feria en el hipodromo','08-15-2021','08-15-2021','08:00:00');

select * from TipoEvento;
select * from Eventos;