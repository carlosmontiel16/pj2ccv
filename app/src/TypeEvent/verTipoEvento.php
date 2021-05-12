<html lang="es">
    <header>
        <title>
            Lista de Tipos de Eventos
        </title>
        <meta charset="utf-8">
    </header>
    <body>
        <center>
            <h1>Listado de Tipo de Eventos </h1>

            <?php
                $link = pg_connect("host=localhost port=5432 dbname=calendario user=postgres password=postgres") or die ("Error: Unable to connect database");
                
                $query = "SELECT * FROM tipoeventos ORDER BY id_tipo";
                $result = pg_query($link,$query) or die ("Query failed " . pg_errormessage($link));

                $id_tipo = 0;
                $nombre = "";
                echo "<table border=1>\n";
                echo "\t<tr>\n";
                echo "\t\t<th><b>id_tipo</b></th>\n";
                echo "\t\t<th><b>Nombre</b></th>\n";
                echo "\t</tr>\n";

                while($line = pg_fetch_array($result,null,PGSQL_ASSOC)){
                    $id_tipo = $line["id_tipo"];
                    $nombre = $line["nombre"];

                    echo "\t<tr>\n";
                    echo "\t\t<td>$id_tipo</td>\n";
                    echo "\t\t<td>$nombre</td>\n";
                    echo "\t\t<td><a href='modificarTipoEvento.php?id_tipo=$id_tipo&nombre=", urlencode($nombre),"'>modificar</a></td>";
                    echo "\t\t<td><a href=eliminarTipo.php?id_tipo=$id_tipo>Eliminar</a></td>\n";
                    echo "\t</tr>\n";
                }

                echo "</table>\n";

                pg_close($link);
            ?><br><br>
            <button><a href="AdminTipoEvento.html">Regresar</a></button>
        </center>
    </body>
</html>