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
				

				$sql = "INSERT INTO Eventos (id_tipo, frecuencia, titulo_Evento, descripcion, fecha_inicio, fecha_fin, hora) VALUES ($idtipo,'$frecuencia','$titulo','$des','$fecha_inicio','$fecha_fin','$hora');";
				$result = pg_query($link,$sql) or die ("Query failed" . pg_errormessage($link));
				echo "true";
				break;
				case 'D':
				# code...
				$fecha_fin = $_GET["fecha_fin"];
				$fecha=date( "Y-m-d", strtotime( "$fecha_inicio" ) );

				for ($i=$fecha; $i <= $fecha_fin ; $i = date( "Y-m-d", strtotime( "$i +1 day" ) )) { 
					$sql = "INSERT INTO Eventos (id_tipo, frecuencia, titulo_Evento, descripcion, fecha_inicio, fecha_fin, hora) VALUES ($idtipo,'$frecuencia','$titulo','$des','$i','$fecha_fin','$hora');";
					$result = pg_query($link,$sql) or die ("Query failed" . pg_errormessage($link));
					# code...
				}
				echo "true";


				break;
				case 'S':
				$fecha_fin = $_GET["fecha_fin"];
				$fecha=date( "Y-m-d", strtotime( "$fecha_inicio" ) );

				for ($i=$fecha; $i <= $fecha_fin ; $i = date( "Y-m-d", strtotime( "$i +7 day" ) )) { 
					$sql = "INSERT INTO Eventos (id_tipo, frecuencia, titulo_Evento, descripcion, fecha_inicio, fecha_fin, hora) VALUES ($idtipo,'$frecuencia','$titulo','$des','$i','$fecha_fin','$hora');";
					$result = pg_query($link,$sql) or die ("Query failed" . pg_errormessage($link));
					# code...
				}
				echo "true";
				# code...
				break;
				case 'M':
				$fecha_fin = $_GET["fecha_fin"];
				$fecha=date( "Y-m-d", strtotime( "$fecha_inicio" ) );

				for ($i=$fecha; $i <= $fecha_fin ; $i = date( "Y-m-d", strtotime( "$i +1 month" ) )) { 
					$sql = "INSERT INTO Eventos (id_tipo, frecuencia, titulo_Evento, descripcion, fecha_inicio, fecha_fin, hora) VALUES ($idtipo,'$frecuencia','$titulo','$des','$i','$fecha_fin','$hora');";
					$result = pg_query($link,$sql) or die ("Query failed" . pg_errormessage($link));
					# code...
				}
				# code...
				echo "true";
				break;
				case 'A':
				$fecha_fin = $_GET["fecha_fin"];
				$fecha=date( "Y-m-d", strtotime( "$fecha_inicio" ) );

				for ($i=$fecha; $i <= $fecha_fin ; $i = date( "Y-m-d", strtotime( "$i +1 year" ) )) { 
					$sql = "INSERT INTO Eventos (id_tipo, frecuencia, titulo_Evento, descripcion, fecha_inicio, fecha_fin, hora) VALUES ($idtipo,'$frecuencia','$titulo','$des','$i','$fecha_fin','$hora');";
					$result = pg_query($link,$sql) or die ("Query failed" . pg_errormessage($link));
					# code...
				}
				# code...
				echo "true";
				break;
				case 'O':
				# code...
				$fecha_fin = $_GET["fecha_fin"];
				$json_ob = json_decode($_GET["obj"]);
				$fecha=date( "Y-m-d", strtotime( "$fecha_inicio" ) );
				for ($i=$fecha; $i <= $fecha_fin ; $i = date( "Y-m-d", strtotime( "$i +1 day" ) )) { 
					$sql = "INSERT INTO Eventos (id_tipo, frecuencia, titulo_Evento, descripcion, fecha_inicio, fecha_fin, hora) VALUES ($idtipo,'$frecuencia','$titulo','$des','$i','$fecha_fin','$hora');";
					$day_name = date('D', strtotime($i));
					switch ($day_name) {
						case 'Mon':
							# code...
							if($json_ob->L){
								$result = pg_query($link,$sql) or die ("Query failed" . pg_errormessage($link));
							}
							break;
							case 'Tue':
							if($json_ob->Ma ){
								$result = pg_query($link,$sql) or die ("Query failed" . pg_errormessage($link));
							}
							# code...
							break;
						case 'Wed':
						if($json_ob->M){
								$result = pg_query($link,$sql) or die ("Query failed" . pg_errormessage($link));
							}
							# code...
							break;
						case 'Thurs':
						if($json_ob->J){
								$result = pg_query($link,$sql) or die ("Query failed" . pg_errormessage($link));
							}
							# code...
							break;
						case 'Fri':
						if($json_ob->V){
								$result = pg_query($link,$sql) or die ("Query failed" . pg_errormessage($link));
							}
							# code...
							break;
						case 'Sat':
						if($json_ob->S){
								$result = pg_query($link,$sql) or die ("Query failed" . pg_errormessage($link));
							}
							# code...
							break;
						case 'Sun':
						if($json_ob->D){
								$result = pg_query($link,$sql) or die ("Query failed" . pg_errormessage($link));
							}
							# code...
							break;
						
						
						default:
							# code...
							break;
					}
					
					# code...
				}
				echo "true";

				break;
			
			default:
				# code...
				break;
		}
	}
}
?>