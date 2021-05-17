<html>
    <header>
        <title>
            Insertando Evento
        </title>
        <style>
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
    </header>
    <body>
        <center>
        <?php
        
            $id_evento = $_GET["id_evento"];
            $id_tipo = $_GET["id_tipo"];
            $titulo = $_GET["titulo"];
            $descripcion = $_GET["descripcion"];
            $fechainicio = $_GET["fechainicio"];
            $fechafin = $_GET["fechafin"];
            $hora = $_GET["hora"];
            $frecuencia = $_GET["frecuencia"];
            
            $link = pg_connect("host=localhost port=5432 dbname=calendario user=postgres password=postgres") or die ("Error: Unable to connect database");
                
            $query = "INSERT INTO eventos VALUES ($id_evento, $id_tipo, '$frecuencia','$titulo','$descripcion','$fechainicio','$fechafin', '$hora')";

            $result = pg_query($link,$query) or die ("Query failed " . pg_errormessage($link));
            echo "Tipo Evento insertada con exito!";
            pg_close($link);
        ?><br><br>
        <button><a href="../index.php">Regresar</a></button>
    </center>
    </body>
</html>