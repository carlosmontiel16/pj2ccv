<html>
    <header>
        <title>
            Lista de Eventos
        </title>
    </header>
    <body>
        <center>
            <h1>Listado de Evento </h1>

            <?php
                $link = pg_connect("host=localhost port=5432 dbname=calendario user=postgres password=postgres") or die ("Error: Unable to connect database");
                
                $query = "SELECT * FROM eventos ORDER BY id_evento";
                $result = pg_query($link,$query) or die ("Query failed " . pg_errormessage($link));
                /*
                $query2 = "SELECT * FROM tipoeventos";
                $result2 = pg_query($link,$query2) or die ("Query failed" . pg_errormessage($link) );*/

                $id_tipo = 0;
                $id_evento = 0;
                $tituloEvento = "";
                $descripcion = "";
                $fechainicio = "";
                $fechafin = "";
                $hora = "";
                $frecuencia = "";
                $id_tipoaux = 0;
                $nombreaux = "";
                
                echo "<table border=1>\n";
                echo "\t<tr>\n";
                echo "\t\t<th><b>Id Evento</b></th>\n";
                echo "\t\t<th><b>Tipo de Evento</b></th>\n";
                echo "\t\t<th><b>Titulo del Evento</b></th>\n";
                echo "\t\t<th><b>Descripcion</b></th>\n";
                echo "\t\t<th><b>Fecha Inicio</b></th>\n";
                echo "\t\t<th><b>Fecha Fin</b></th>\n";
                echo "\t\t<th><b>Hora</b></th>\n";
                echo "\t\t<th><b>Frecuecia</b></th>\n";                
                echo "\t</tr>\n";

                
                /*while($line2 = pg_fetch_array($result2,null,PGSQL_ASSOC)){
                    $id_tipoaux = $line2["id_tipo"];
                    $nombreaux = $line2["nombre"];
                }*/
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
                    echo "\t\t<th>$id_tipo</th>\n";
/*
                    if($id_tipo = $id_tipoaux){
                        echo "\t\t<th>$id_tipo = $nombreaux </th>\n";
                    }
*/                    
                    echo "\t\t<th>$tituloEvento</th>\n";
                    echo "\t\t<th>$descripcion</th>\n";
                    echo "\t\t<th>$fechainicio</th>\n";
                    echo "\t\t<th>$fechafin</th>\n";
                    echo "\t\t<th>$hora</th>\n";
                    echo "\t\t<th>$frecuencia</th>\n";
                    echo "\t\t<td><a href='modif_event.php?id_evento=$id_evento&id_tipo=$id_tipo&tituloEvento=", urlencode($tituloEvento),"&descripcion=", urlencode($descripcion),"&fechainicio=$fechainicio&fechafin=$fechafin&hora=$hora&frecuencia=$frecuencia'>modificar</a></td>";
                    echo "\t\t<td><a href=eliminar_evento.php?id_evento=$id_evento>Eliminar</a></td>\n";
                    echo "\t</tr>\n";
                }
                echo "</table>\n";

                pg_close($link);
            ?><br><br>
            <button><a href="AdminEvento.html">Regresar</a></button>
        </center>
    </body>
</html>