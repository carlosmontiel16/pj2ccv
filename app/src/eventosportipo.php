<html>
    <header>
        <title>
            Eventos por tipo
        </title>
    </header>
    <body>
        <center>
            <h1>Reporte de Eventos por tipo</h1>
            <?php
                $id_tipo = $_GET["id_tipo"];
                $link = pg_connect("host=localhost port=5432 dbname=calendario user=postgres password=postgres") or die ("Error: Unable to connect database");
                    
                $query = "SELECT * FROM eventos WHERE id_tipo = $id_tipo ORDER BY id_evento";
                $result = pg_query($link,$query) or die ("Query failed " . pg_errormessage($link));

                echo "<table border=1>\n";
                echo "\t<tr>\n";
                echo "\t\t<th>Id Evento</th>\n";
                //echo "\t\t<th>Tipo de Evento</th>\n";
                echo "\t\t<th>Titulo del Evento</th>\n";
                echo "\t\t<th>Descripcion</th>\n";
                echo "\t\t<th>Fecha Inicio</th>\n";
                echo "\t\t<th>Fecha Fin</th>\n";
                echo "\t\t<th>Hora</th>\n";
                echo "\t\t<th>Frecuencia</th>\n";                
                echo "\t</tr>\n";
    
                while($line = pg_fetch_array($result,null,PGSQL_ASSOC)){
                    $id_tipo = $line["id_tipo"];
                    $id_evento = $line["id_evento"];
                    $tituloEvento = $line["tituloevento"];
                    $descripcion = $line["descripcion"];
                    $fechainicio = $line["fechainicio"];
                    $fechafin = $line["fechafin"];
                    $hora = $line["hora"];
                    $frecuencia = $line["frecuencia"];
    
                    switch($frecuencia){
                        case "U":
                            $frecuencia = "Una sola vez";
                            break;
                        case "D":
                            $frecuencia = "Diario";
                            break;
                        case "S":
                            $frecuencia = "Semanal";
                            break;
                        case "M":
                            $frecuencia = "Mensual";
                            break;
                        case "A":
                            $frecuencia = "Anual";
                            break;
                        case "O":
                            $frecuencia = "Dias alternos";
                            break;
                        }
    
                    echo "\t<tr>\n";
                    echo "\t\t<th>$id_evento</th>\n";
                    //echo "\t\t<th>$id_tipo</th>\n";                 
                    echo "\t\t<th>$tituloEvento</th>\n";
                    echo "\t\t<th>$descripcion</th>\n";
                    echo "\t\t<th>$fechainicio</th>\n";
                    echo "\t\t<th>$fechafin</th>\n";
                    echo "\t\t<th>$hora</th>\n";
                    echo "\t\t<th>$frecuencia</th>\n";
                    echo "\t</tr>\n";
                }
                echo "</table>\n";
                pg_close($link);
            ?><br><br>
            <button><a href="reportes.html">Regresar</a></button>
        </center>
    </body>
</html>