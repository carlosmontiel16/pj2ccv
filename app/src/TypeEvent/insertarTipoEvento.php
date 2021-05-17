<html>
    <header>
        <title>
            Insertar Tipo de Evento
        </title>
        <style>
        button{
            background-color: navy;
            width: 50px;
            height: 50px;
            color: white;
        }   
        a{
            text-decoration: none;
            color: white;
            font-weight: bold;
            font-size: medium;
        }

        body{
            background-color: green;
        }
        input{
            margin: 1px solid black;
            width: 250px;
            height: 25px;
        }
        #enviar{
            background-color: navy;
            width: 50px;
            height: 50px;
            color: white;
        }
        </style>
    </header>
    <body>
        <center>
            <h3>Insertar Tipos de Evento </h3>
            <form action="insertTipEve.php" method="get">
                
                <?php
                    $link = pg_connect("host=localhost port=5432 dbname=calendario user=postgres password=postgres") or die ("Error: Unable to connect database");
                    $query = "SELECT (1 + (SELECT MAX(id_tipo) FROM tipoevento)) as id_tipo";
    
                    $result = pg_query($link,$query) or die ("Query failed " . pg_errormessage($link));

                    $id_tipo = 0;
                    while($line = pg_fetch_array($result,null,PGSQL_ASSOC)){
                        $id_tipo = $line["id_tipo"];
                        echo "<b>Id del Tipo de Evento: $id_tipo</b>";
                        echo "<input id=nomeve type=hidden name=id_tipo value=$id_tipo ><br><br>";
                    } 
                    echo "<b>Nombre del Evento";
                    echo "<input type=text name=nombre placeholder='Escriba nombre del tipo de evento' required><br><br>";
                    pg_close($link);
                    
                ?>
                <input id="enviar" type="submit" value="Enviar">
            </form>
            <button onclick="self.close()">Cerrar</button>
        </center>
    </body>
</html>