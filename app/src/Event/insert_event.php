<html>
    <header>
        <title>
            Insertar Evento
        </title>
    </header>
    <body>
        <center>
            <h3>Insertar Evento </h3>
            <form action="insertEve.php" method="get">
                <b>Id del Evento: </b>
                <input type="number" name="id_evento" min=1 required><br><br>

                <b>Tipo de Evento: </b>

                <?php

                    $link = pg_connect("host=localhost port=5432 dbname=calendario user=postgres password=postgres") or die ("Error: Unable to connect database");

                    $query = "SELECT * FROM tipoeventos ORDER BY id_tipo";
                    $result = pg_query($link,$query) or die ("Query failed" . pg_errormessage($link));

                    echo "<select name=id_tipo>\n";
                    while($line = pg_fetch_array($result,null,PGSQL_ASSOC)){
                        $id_tipo = $line["id_tipo"];
                        $nombre = $line["nombre"];
    
                        echo "<option value=$id_tipo> $id_tipo = $nombre </option>";
                    }
                    echo "</select>\n";
                    pg_close($link);
                ?><br><br>
                
                <b>Titulo del Evento: </b>
                <input type="text" name="titulo" required><br><br>

                <b>Descripcion: </b>
                <input type="text" name="descripcion" required><br><br>

                <b>Fecha de Inicio: </b>
                <input type="date" name="fechainicio" value="<?php echo $_GET['year'] . '-'.  $_GET['month'] .'-' .  $_GET['day']   ?>" required><br><br>

                <b>Fecha Fin: </b>
                <input type="date" name="fechafin" required><br><br>

                <b>Hora: </b>
                <input type="time" name="hora" required><br><br>
                <b>Frecuencia: </b>
                <select name="frecuencia">
                    <option value="U">Una sola vez</option>
                    <option value="D">Diario</option>
                    <option value="S">Semanal</option>
                    <option value="M">Mensual</option>
                    <option value="A">Anual</option>
                    <option value="O">Dias Alternos</option>
                </select><br><br>

                <input type="submit" value="Enviar">
            </form>
            <button onclick="self.close()">Cerrar</button>
        </center>
    </body>
</html>