<html>
    <header>
        <title> Eventos por tipo</title>
    </header>
    <body>
        <center>
            <h2>Eventos por tipo: </h2>
            <form action="eventosportipo.php" method="get">
            <?php
                $link = pg_connect("host=localhost port=5432 dbname=calendario user=postgres password=postgres") or die ("Error: Unable to connect database");
            
                $query = "SELECT * FROM tipoeventos ORDER BY id_tipo";
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
            <input type="submit" value="Enviar">
            </form>
        </center>
    </body>
</html>