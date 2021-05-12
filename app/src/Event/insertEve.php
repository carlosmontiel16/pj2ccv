<html>
    <header>
        <title>
            Insertando Evento
        </title>
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
                
            $query = "INSERT INTO eventos VALUES ($id_evento,$id_tipo,'$titulo','$descripcion','$fechainicio','$fechafin', '$hora', '$frecuencia')";

            $result = pg_query($link,$query) or die ("Query failed " . pg_errormessage($link));
            echo "Tipo Evento insertada con exito!";
            pg_close($link);
        ?><br><br>
        <button onclick="self.close()">Cerrar</button>
        </center>
    </body>
</html>