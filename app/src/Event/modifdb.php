<html>
    <header>
        <title>Modificando Evento</title>
    </header>
    <body>
        <center>
            <?php
            $id_evento = $_POST["id_evento"];
            $id_tipo = $_POST["id_tipo"];
            $titulo = $_POST["titulo"];
            $descripcion = $_POST["descripcion"];
            $fechainicio = $_POST["fechainicio"];
            $fechafin = $_POST["fechafin"];
            $hora = $_POST["hora"];
            $frecuencia = $_POST["frecuencia"];

            $link = pg_connect("host=localhost port=5432 dbname=calendario user=postgres password=postgres") or die ("Error: Unable to connect database");
                
            $query = "UPDATE eventos SET id_tipo = $id_tipo,titulo_evento = '$titulo', descripcion = '$descripcion', fecha_inicio = '$fechainicio', fecha_fin = '$fechafin', hora = '$hora', frecuencia='$frecuencia' WHERE id_evento = $id_evento";

            $result = pg_query($link,$query) or die ("Query failed " . pg_errormessage($link));

            echo "Tipo Evento insertada con exito!";
            pg_close($link);
            ?><br><br>
            <button><a href="../index.php">Regresar</a></button>
        </center>
    </body>
</html>