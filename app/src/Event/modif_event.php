<html>
    <header>
        <title>
            Modificando Evento
        </title>
    </header>
    <body>
        <center>
            <h3>Modificando Evento </h3>
            <form action="modifdb.php" method="POST">
                
                <?php
                    $id_evento = $_GET["id_evento"];
                    $id_tipo = $_GET["id_tipo"];
                    $titulo = $_GET["tituloEvento"];
                    $descripcion = $_GET["descripcion"];
                    $fechainicio = $_GET["fechainicio"];
                    $fechafin = $_GET["fechafin"];
                    $hora = $_GET["hora"];
                    $frecuencia = $_GET["frecuencia"];
                    //$id_tipoaux = 0;

                    echo "<b>Id del Evento: $id_evento </b>";
                    echo "<input type=hidden name=id_evento value=$id_evento> <br><br>\n";

                    echo "<b>Tipo de Evento: </b> ";

                    $link = pg_connect("host=localhost port=5432 dbname=calendario user=postgres password=postgres") or die ("Error: Unable to connect database");

                    $query = "SELECT * FROM tipoeventos ORDER BY id_tipo";
                    $result = pg_query($link,$query) or die ("Query failed" . pg_errormessage($link));

                    echo "<select name=id_tipo>\n";
                    while($line = pg_fetch_array($result,null,PGSQL_ASSOC)){
                        $id_tipoaux = $line["id_tipo"];
                        $nombre = $line["nombre"];
                        echo "<option value=$id_tipo> $id_tipo = $nombre </option>";
                    }
                    echo "</select>\n <br><br>";

                    pg_close($link);
                    
                    echo "<b>Titulo del Evento: </b>";
                    echo "<input type=text name=titulo value='$titulo' required><br><br>";

                    echo "<b>Descripcion: </b>";
                    echo "<input type=text name=descripcion value='$descripcion' required><br><br>";

                    echo "<b>Fecha de Inicio: </b>";
                    echo "<input type=date name=fechainicio value='$fechainicio' required><br><br>";

                    echo "<b>Fecha Fin: </b>";
                    echo "<input type=date name=fechafin value='$fechafin' required><br><br>";

                    echo "<b>Hora: </b>";
                    echo "<input type=time name=hora value='$hora' required><br><br>";
                    echo "<b>Frecuencia: </b>";
                    
                    echo "<select name=frecuencia>";
                    //echo "<option selected value='$frecuencia'>$frecuencia</option>";
                    switch ($frecuencia) {
                        case 'Una sola vez':
                            $frecuencia = 'U';
                            break;
                        case 'Diario':
                            $frecuencia = 'D';
                            break;
                        case 'Semanal':
                            $frecuencia = 'S';
                            break;
                        case 'Mensual':
                            $frecuencia = 'M';
                            break;
                        case 'Anual':
                            $frecuencia = 'A';
                            break;
                        case 'Dias Alternos':
                            $frecuencia = 'O';
                            break;
                    }
                    echo "<option value=U>Una sola vez</option>";
                    echo "<option value=D>Diario</option>";
                    echo "<option value=S>Semanal</option>";
                    echo "<option value=M>Mensual</option>";
                    echo "<option value=A>Anual</option>";
                    echo "<option value=O>Dias Alternos</option>";
                    echo "</select><br><br>";
                ?> 
            <input type=submit value=Enviar>
            </form>
            <button><a href="AdminEvento.html">Regresar</a></button>
        </center>
    </body>
</html>