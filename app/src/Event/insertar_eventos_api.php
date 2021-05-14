<?php
if(isset($_GET)){
	if(isset($_GET["frecuencia"])){
		 $link = pg_connect("host=localhost port=5432 dbname=calendario user=postgres password=postgres") or die ("Error: Unable to connect database");
		$id = $_GET["id"];
		$idtipo = $_GET["id_tipo"];
		$titulo = $_GET["titulo"];
		$des = $_GET["desc"];
		$fecha_inicio = $_GET["fecha_inicio"];
		$hora = $_GET["hora"];
		$frecuencia = $_GET["frecuencia"];
		switch ($frecuencia)	 {
				case 'U':
				# code..
				$fecha_fin = $_GET["fecha_fin"];
				

				$sql = "INSERT INTO Eventos VALUES ($id,$idtipo,'$frecuencia','$titulo','$des','$fecha_inicio','$fecha_fin','$hora');";
				$result = pg_query($link,$sql) or die ("Query failed" . pg_errormessage($link));
				echo "true";
				break;
				case 'D':
				# code...
				$fecha_fin = $_GET["fecha_fin"];
				$fecha=date( "Y-m-d", strtotime( "$fecha_inicio" ) );

				for ($i=$fecha; $i <= $fecha_fin ; $i = date( "Y-m-d", strtotime( "$i +1 day" ) )) { 
					$sql = "INSERT INTO Eventos VALUES ($id,$idtipo,'$frecuencia','$titulo','$des','$i','$fecha_fin','$hora');";
					echo $sql;
					$result = pg_query($link,$sql) or die ("Query failed" . pg_errormessage($link));
					# code...
				}


				break;
				case 'S':
				# code...
				break;
				case 'M':
				# code...
				break;
				case 'A':
				# code...
				break;
				case 'O':
				# code...
				break;
			
			default:
				# code...
				break;
		}
	}
}
?>