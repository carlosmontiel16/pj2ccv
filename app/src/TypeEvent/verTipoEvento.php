<html lang="es">
    <header>
        <title>
            Lista de Tipos de Eventos
        </title>
        <meta charset="utf-8">
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
            a{
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
            <h1>Listado de Tipo de Eventos </h1>

            <?php
                $link = pg_connect("host=localhost port=5432 dbname=calendario user=postgres password=postgres") or die ("Error: Unable to connect database");
                
                $query = "SELECT * FROM tipoevento ORDER BY id_tipo";
                $result = pg_query($link,$query) or die ("Query failed " . pg_errormessage($link));

                $id_tipo = 0;
                $nombre = "";
                echo "<table border=1>\n";
                echo "\t<tr>\n";
                echo "\t\t<th><b>Id Tipo Evento</b></th>\n";
                echo "\t\t<th><b>Nombre</b></th>\n";
                echo "\t</tr>\n";

                while($line = pg_fetch_array($result,null,PGSQL_ASSOC)){
                    $id_tipo = $line["id_tipo"];
                    $nombre = $line["nombre"];

                    echo "\t<tr>\n";
                    echo "\t\t<td>$id_tipo</td>\n";
                    echo "\t\t<td>$nombre</td>\n";
                    echo "\t\t<td><a href='modificarTipoEvento.php?id_tipo=$id_tipo&nombre=", urlencode($nombre),"'><img src='../img/modifyicon.png' alt='modify-icon' height=75 width=75></a></td>";
                    echo "\t\t<td><a href=eliminarTipo.php?id_tipo=$id_tipo><img src='../img/deleteicon.png' alt='delete-icon' height=75 width=75></a></td>\n";
                    echo "\t</tr>\n";
                }

                echo "</table>\n";

                pg_close($link);
            ?><br><br>
            <button><a href="AdminTipoEvento.html">Regresar</a></button>
        </center>
    </body>
</html>