<html lang="es">
	<head>
		<title>Ver evento seleccionado</title>
		<meta charset="UTF-8"/>
	</head>
	<style>
		table {
			font-family: arial, sans-serif;
			border-collapse: collapse;
		}

		td, th {
			border: 1px solid #dddddd;
			text-align: left;
			padding: 8px;
		}

		tr:nth-child(even) {
			
			background-color: steelblue;
		}
		a {
			text-decoration: none;
			color: white;
			font-weight: bold;
			font-size: medium;
		}
		button{
			background-color: navy;
			width: 150px;
			height: 50px;
		}
	</style>
	<body>
		<center>
			<?php
				$day = $_GET["day"];
				$month = $_GET["month"];
				$year = $_GET["year"];
				
				$fecha = "$year-$month-$day";
				
				setlocale(LC_TIME,"Spanish_Guatemala","es_ES.UTF-8");
				
				echo '<h2>' .strftime("%A, %d de %B de %Y",strtotime($fecha)).'</h2>';

				
				$link = pg_connect("host=localhost port=5432 dbname=calendario user=postgres password=postgres") or die ("Error: Unable to connect database");
				
				$query = "SELECT *  FROM eventos WHERE fecha_inicio = '$fecha'";
				$result = pg_query($link,$query) or die ("Query failed " . pg_errormessage($link));
				
				
                $id_tipo = 0;
                $id_evento = 0;
                $tituloEvento = "";
                $descripcion = "";
                $fechainicio = "";
                $fechafin = "";
                $hora = "";
                $frecuencia = "";
				
				echo "<table border=1>";
				echo "<tr>";
				echo "<th>Id del Evento</th>";
				echo "<th>Tipo de Evento</th>";
				echo "<th>Titulo del Evento</th>";
				echo "<th>Descripcion</th>";
				echo "<th>Fecha Inicio</th>";
				echo "<th>Fecha Fin</th>";
				echo "<th>Hora</th>";
				echo "<th>Frecuencia</th>";
				echo "</tr>";
				$frecuenciaaux = "";
				$nombre = "";
				$id_tipoaux = 0;
				while($line = pg_fetch_array($result,null,PGSQL_ASSOC)){
					$id_tipo = $line["id_tipo"];
					$id_evento = $line["id_evento"];
					$tituloEvento = $line["titulo_evento"];
					$descripcion = $line["descripcion"];
					$fechainicio = $line["fecha_inicio"];
					$fechafin = $line["fecha_fin"];
					$hora = $line["hora"];
					$frecuencia = $line["frecuencia"];
					$frecuenciaaux = $frecuencia;
					
					echo "<tr>";
					echo "<td>$id_evento</td>";
					
					$query2 = "SELECT * FROM TipoEvento WHERE id_tipo = $id_tipo";
					$result2 = pg_query($link,$query2) or die ("Query failed " . pg_errormessage($link));
					
					while($line2 = pg_fetch_array($result2,null,PGSQL_ASSOC)){
						$id_tipoaux = $line2["id_tipo"];
						$nombre = $line2["nombre"];
						if($id_tipo == $id_tipoaux){
							echo "<td> $nombre </td>";
						}
					}

					echo "<td>$tituloEvento</td>";
					echo "<td>$descripcion</td>";
					echo "<td>$fechainicio</td>";
					echo "<td>$fechafin</td>";
					echo "<td>$hora</td>";
					switch ($frecuenciaaux) {
						case 'U':
							$frecuenciaaux = 'Una sola vez';
							break;
						case 'D':
							$frecuenciaaux = 'Diario';
							break;
						case 'S':
							$frecuenciaaux = 'Semanal';
							break;
						case 'M':
							$frecuenciaaux = 'Mensual';
							break;
						case 'A':
							$frecuenciaaux = 'Anual';
							break;
						case 'O':
							$frecuenciaaux = 'Dias Alternos';
							break;
						}
					echo "<td>$frecuenciaaux</td>";
					echo "\t\t<td><a href='modif_event.php?id_evento=$id_evento&id_tipo=$id_tipo&tituloEvento=", urlencode($tituloEvento),"&descripcion=", urlencode($descripcion),"&fechainicio=$fechainicio&fechafin=$fechafin&hora=$hora&frecuencia=$frecuencia'><img src='../img/modifyicon.png' alt='delete-icon' height=75 width=75></a></td>";
                    echo "\t\t<td><a href=eliminar_evento.php?id_evento=$id_evento><img src='../img/deleteicon.png' alt='delete-icon' height=75 width=75></a></td>\n";
					echo "</tr>";
                    }
					echo "</table>";
				pg_close($link);
			?><br><br>
			<button><a href="../index.php">Regresar</a></button>
		</center>
	</body>
</html>