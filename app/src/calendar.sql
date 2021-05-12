CREATE TABLE tipoeventos(
	id_tipo INTEGER NOT NULL PRIMARY KEY,
	nombre VARCHAR(20)
);

CREATE TABLE eventos(
	id_evento INTEGER NOT NULL PRIMARY KEY,
	id_tipo INTEGER NOT NULL REFERENCES tipoeventos(id_tipo),
	tituloevento VARCHAR(30),
	descripcion VARCHAR(70),
	fechainicio DATE,
	fechafin DATE,
	hora TIME,
	frecuencia CHAR(1),
	CHECK (frecuencia IN('U','D','S','M','A','O'))
);
INSERT INTO tipoeventos VALUES (5,'Pago');
INSERT INTO eventos VALUES (1,3,'Feriado 15 de Agosto','Feria de Jocotenango, hipodromo del norte','2021-10-05','2021-10-05','11:00:00','A');

SELECT * FROM tipoeventos;
SELECT * FROM eventos;