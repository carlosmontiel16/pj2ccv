<html>
    <header>
        <title>
            Insertar Evento
        </title>
        <style>
            .contenier{
                width: 450px;
                height: 680px;
                background-color: green;
                border: 5px outset navy;
                margin-top: 25px;
                align-items: center;
                justify-content: center;
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
            #enviar{
                background-color: navy;
                width: 150px;
                height: 50px;
                color: white;
                font-weight: bold;
                font-size: medium;
            }
            input{
                border: 3px outset navy;
                width: 150px;
            }
            select {
                border: 3px outset navy;
                width: 150px;
            }
            .descrip{
                height: 75px;
                width: 150px;
                border: 3px outset navy;
            }
            .invisible{
                margin: 0px;
                padding: 0px;
                justify-content: flex-end;
                width: 120px;
                height: 600px;
/*                border: 5px outset red;*/
            }
            h2{
                margin: 5px;
            }
        </style>
    </header>
    <body>
        <center>
            <div class="contenier">
                <h2>Insertar Evento </h2>
                <div class="invisible">
                    <form action="insertEve.php" method="GET">
                        
                        <?php
        
                        $link = pg_connect("host=localhost port=5432 dbname=calendario user=postgres password=postgres") or die ("Error: Unable to connect database");
                        $id_evento=0;
                        $query = "SELECT (1 + (SELECT MAX(id_evento) FROM eventos)) AS id_evento;";
                        $result = pg_query($link,$query) or die ("Query failed" . pg_errormessage($link));
                        while($line = pg_fetch_array($result,null,PGSQL_ASSOC)){
                            $id_evento = $line["id_evento"];
                            echo "<b>Id del Evento: $id_evento </b> ";
                            echo "<input type=hidden name=id_evento value=$id_evento min=1 required><br><br>";
                        }
                       
                        echo "<b>Tipo de Evento: </b>";
                        $query2 = "SELECT * FROM tipoevento ORDER BY id_tipo";
                        $result2 = pg_query($link,$query2) or die ("Query failed" . pg_errormessage($link));
        
                        echo "<select name=id_tipo>\n";
                        while($line2 = pg_fetch_array($result2,null,PGSQL_ASSOC)){
                            $id_tipo = $line2["id_tipo"];
                            $nombre = $line2["nombre"];
        
                            echo "<option value=$id_tipo> $id_tipo = $nombre </option>";
                        }
                        echo "</select>\n";
                        pg_close($link);
                        ?><br><br>
                        
                        <b>Titulo del Evento: </b>
                        <input type="text" name="titulo" required><br>
        
                        <b>Descripcion:</b><br>
                        <textarea name="descripcion" class="descrip"></textarea> <br>
                        <!--<input class="descrip" type="text" name="descripcion" required><br><br> !-->
        
                        <b>Fecha de Inicio: </b>
                        <input type="date" name="fechainicio" value="<?php echo $_GET['year'] . '-'.  $_GET['month'] .'-' .  $_GET['day'] ?>" required><br><br>
        
                        <b>Fecha Fin: </b>
                        <input type="date" name="fechafin" required><br>
        
                        <b>Hora: </b>
                        <input type="time" name="hora" min="08:00" max="20:59" required><br>
                        <b>Frecuencia: </b>
                        <select name="frecuencia">
                            <option value="U">Una sola vez</option>
                            <option value="D">Diario</option>
                            <option value="S">Semanal</option>
                            <option value="M">Mensual</option>
                            <option value="A">Anual</option>
                            <option value="O">Dias Alternos</option>
                        </select><br><br>
                        <input id="enviar" type="submit" value="Enviar">
                    </form>
                    <button><a href="../index.php">Regresar</a></button>
                </div>
            </div>
        </center>
    </body>
</html>