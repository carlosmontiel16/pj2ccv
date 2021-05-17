<html>
    <header>
        <title> Eventos por tipo</title>
    </header>
    <style>
        button{
            background-color: navy;
            width: 150px;
            height: 100px;
        }   
        a{
            text-decoration: none;
            color: white;
            font-weight: bold;
            font-size: medium;
        }
        #enviar{
            background-color: navy;
            width: 150px;
            height: 100px;
            color: white;
            font-weight: bold;
            font-size: medium;
        }
        select{
            background-color: #0563af;
            color: white;
            padding: 12px;
            width: 200px;
            border: none;
            font-size: 17px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.2);
            -webkit-appearance: button;
            appearance: button;
            outline: none;
        }
    </style>
    <body>
        <center>
            <h2>Eventos por tipo: </h2>
            <form action="eventosportipo.php" method="get">
            <?php
                $link = pg_connect("host=localhost port=5432 dbname=calendario user=postgres password=postgres") or die ("Error: Unable to connect database");
            
                $query = "SELECT * FROM tipoevento ORDER BY id_tipo";
                $result = pg_query($link,$query) or die ("Query failed " . pg_errormessage($link));
                $id_tipo = 0;
                $nombre = "";

                echo "<select name=id_tipo>\n";
                    while($line = pg_fetch_array($result,null,PGSQL_ASSOC)){
                        $id_tipo = $line["id_tipo"];
                        $nombre = $line["nombre"];
                        echo "<option value=$id_tipo> $id_tipo = $nombre </option>";
                    }
                    echo "</select>\n <br><br>";
            ?>
            <input id="enviar" type="submit" value="Ver">
            </form>
            <button><a href="reportes.html">Regresar</a></button>
        </center>
    </body>
</html>