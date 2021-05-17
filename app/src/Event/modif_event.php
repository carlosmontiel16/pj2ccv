<html>
    <header>
        <title>
            Modificando Evento
        </title>
        <style>
            .conteiner{
                width: 450px;
                height: 700px;
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
            <div class="conteiner">
                <h2>Modificando Evento </h2>
                <div class="invisible">
    
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
                            echo "<input type=hidden name=id_evento value=$id_evento> <br> <br>\n";
        
                            echo "<b>Tipo de Evento: </b> ";
        
                            $link = pg_connect("host=localhost port=5432 dbname=calendario user=postgres password=postgres") or die ("Error: Unable to connect database");
        
                            $query = "SELECT * FROM tipoevento ORDER BY id_tipo";
                            $result = pg_query($link,$query) or die ("Query failed" . pg_errormessage($link));
        
                            echo "<select name=id_tipo>\n";
                            while($line = pg_fetch_array($result,null,PGSQL_ASSOC)){
                                $id_tipoaux = $line["id_tipo"];
                                $nombre = $line["nombre"];
                                if($id_tipo == $id_tipoaux){
                                    echo "<option selected value=$id_tipoaux> $id_tipoaux = $nombre </option>";
                                }else{
                                    echo "<option value=$id_tipoaux> $id_tipoaux = $nombre </option>";
                                }
                            }
                            echo "</select>\n <br><br>";
        
                            pg_close($link);
                            
                            echo "<b>Titulo del Evento: </b>";
                            echo "<input type=text name=titulo value='$titulo' required><br><br>";
        
                            echo "<b>Descripcion: </b>";
                            echo "'<textarea name=descripcion class=descrip required>$descripcion </textarea><br><br>";
                            
        
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
                                case 'U':
                                    //$frecuencia = 'U';
                                    echo "<option selected value=U>Una sola vez</option>";
                                    echo "<option value=D>Diario</option>";
                                    echo "<option value=S>Semanal</option>";
                                    echo "<option value=M>Mensual</option>";
                                    echo "<option value=A>Anual</option>";
                                    echo "<option value=O>Dias Alternos</option>";
                                    break;
                                case 'D':
                                    //$frecuencia = 'D';
                                    echo "<option value=U>Una sola vez</option>";
                                    echo "<option selected value=D>Diario</option>";
                                    echo "<option value=S>Semanal</option>";
                                    echo "<option value=M>Mensual</option>";
                                    echo "<option value=A>Anual</option>";
                                    echo "<option value=O>Dias Alternos</option>";
                                    break;
                                case 'S':
                                    //$frecuencia = 'S';
                                    echo "<option value=U>Una sola vez</option>";
                                    echo "<option value=D>Diario</option>";
                                    echo "<option selecteed value=S>Semanal</option>";
                                    echo "<option value=M>Mensual</option>";
                                    echo "<option value=A>Anual</option>";
                                    echo "<option value=O>Dias Alternos</option>";
                                    break;
                                case 'M':
                                    //$frecuencia = 'M';
                                    echo "<option value=U>Una sola vez</option>";
                                    echo "<option value=D>Diario</option>";
                                    echo "<option value=S>Semanal</option>";
                                    echo "<option selected value=M>Mensual</option>";
                                    echo "<option value=A>Anual</option>";
                                    echo "<option value=O>Dias Alternos</option>";
                                    break;
                                case 'A':
                                    //$frecuencia = 'A';
                                    echo "<option value=U>Una sola vez</option>";
                                    echo "<option value=D>Diario</option>";
                                    echo "<option value=S>Semanal</option>";
                                    echo "<option value=M>Mensual</option>";
                                    echo "<option selected value=A>Anual</option>";
                                    echo "<option value=O>Dias Alternos</option>";
                                    break;
                                case 'O':
                                    //$frecuencia = 'O';
                                    echo "<option value=U>Una sola vez</option>";
                                    echo "<option value=D>Diario</option>";
                                    echo "<option value=S>Semanal</option>";
                                    echo "<option value=M>Mensual</option>";
                                    echo "<option value=A>Anual</option>";
                                    echo "<option selected value=O>Dias Alternos</option>";
                                    break;
                            }
                            echo "</select><br>";
                        ?> <br>
                    <input id="enviar" type=submit value=Enviar>
                    </form>
                    <button><a href="../index.php">Regresar</a></button>
                </center>
                </div>
            </div>
    </body>
</html>