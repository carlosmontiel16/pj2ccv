<html>
    <header>
        <title>
            Insertar Evento
        </title>
           <style type="text/css">
        .week{
            table-layout: fixed;
            border: 1px solid red;
            width: 100%;

        }
        .dayTd{
            display: table-cell; border: 1px solid red; height: 120px;

        }
        .dayMonth{
            position: relative;
            left: 90%;
                width: 5%;
                top: -35px;
        }
        .dayTd:hover{
            background-color: lightgray;
        }
        .dayTd:active{
            background-color: lightblue;
        }
        .bgcontainer{
            background-color: #e9ecef;
        }
    </style>
    </header>
    <body>
        <center>
            <div class="contenier">
                            <h3>Insertar Evento </h3>
            <form id="formeventos">

                <b>Tipo de Evento: </b>

                <?php

                    $link = pg_connect("host=localhost port=5432 dbname=calendario user=postgres password=postgres") or die ("Error: Unable to connect database");
                    $query = "SELECT * FROM tipoevento ORDER BY id_tipo";
                    $result = pg_query($link,$query) or die ("Query failed" . pg_errormessage($link));

                    echo "<select id=id_tipo>\n";
                    while($line = pg_fetch_array($result,null,PGSQL_ASSOC)){
                        $id_tipo = $line["id_tipo"];
                        $nombre = $line["nombre"];

                        echo "<option value=$id_tipo> $id_tipo = $nombre </option>";
                    }
                    echo "</select>\n";
                    pg_close($link);
                ?><br><br>

                <b>Titulo del Evento: </b>
                <input type="text" id="titulo" required><br><br>

                <b>Descripcion: </b>
                <input type="text" id="descripcion" required><br><br>

                <b>Fecha de Inicio: </b>
                <input type="date" readonly="true" id="fechainicio" value="<?php echo $_GET['year'] . '-'.  $_GET['month'] .'-' .  $_GET['day']   ?>" required><br><br>

                <b>Fecha Fin: </b>
                <input type="date" id="fechafin" required><br><br>

                <b>Hora: </b>
                <input type="time" id="hora" required><br><br>
                <b>Frecuencia: </b>
                <select id="select_frecuencia" name="frecuencia" onchange="showMiniCalendar();">
                    <option value="U">Una sola vez</option>
                    <option value="D">Diario</option>
                    <option value="S">Semanal</option>
                    <option value="M">Mensual</option>
                    <option value="A">Anual</option>
                    <option value="O">Dias Alternos</option>
                </select><br><br>
                <div style="display: none;" id="containtable">
                                <table class="week">
            <thead>
                <tr>
                    <th>Domingo</th>
                    <th>Lunes</th>
                    <th>Martes</th>
                    <th>Miercoles </th>
                    <th>Jueves</th>
                    <th>Viernes</th>
                    <th>Sabado</th>

                </tr>   
            </thead>
                    <tbody id="init_calendar_body_table">

                <tr class="week">
                     <td class="dayTd" onclick="addFrecuenciaAlterna('D', this)">
                        <div class="dayMonth" >D</div>
                    </td>
                    <td class="dayTd" onclick="addFrecuenciaAlterna('L', this)">
                        <div class="dayMonth">L</div>
                    </td>
                    <td class="dayTd" onclick="addFrecuenciaAlterna('Ma', this)">
                        <div class="dayMonth">M</div>
                    </td>
                    <td class="dayTd" onclick="addFrecuenciaAlterna('M', this)">
                        <div class="dayMonth">M</div>
                    </td>
                    <td class="dayTd" onclick="addFrecuenciaAlterna('J', this)">
                        <div class="dayMonth">J</div>
                    </td>
                    <td class="dayTd" onclick="addFrecuenciaAlterna('V', this)">
                        <div class="dayMonth">V</div>
                    </td>
                    <td class="dayTd" onclick="addFrecuenciaAlterna('S', this)">
                        <div class="dayMonth">S</div>
                    </td>

                </tr>
            </tbody>
            </table>

                    </form>
                    
                </div>
                  <button onclick="sendInformation()">Agregar</button>
                <button onclick="location.href='../'">Cerrar</button>
                <button><a href="../index.php">Regresar</a></button>
            </div>
        </center>
    </body>
      <script type="text/javascript">
        var objeto_alterno = {
            "L": false,
            "Ma": false,
            "M": false,
            "J": false,
            "V": false,
            "S": false,
            "D": false
       };
        function showMiniCalendar(){
            if(document.getElementById("select_frecuencia").value == "O"){

                document.getElementById("containtable").style.display = "block";
                            }
                            else{
                              document.getElementById("containtable").style.display = "none";  

                            }
        }
        function addFrecuenciaAlterna(p, e){
            this.objeto_alterno[p] = !this.objeto_alterno[p];
             e.addEventListener("mouseenter", (event) => { event.target.style.backgroundColor = "lightgray" });

            if(this.objeto_alterno[p]){
                e.style.backgroundColor = "lightgreen";
                e.addEventListener("mouseleave", (event) => { event.target.style.backgroundColor = "lightgreen" })

            }
            else{
                e.style.backgroundColor = "white";
                e.addEventListener("mouseleave", (event) => { event.target.style.backgroundColor = "white" })
            }


        }

        function sendInformation(){
            //var id = document.getElementById("id_evento").value;
            var id_tipo = document.getElementById("id_tipo").value;
            var titulo = document.getElementById("titulo").value;
            var desc = document.getElementById("descripcion").value;
            var fecha_inicio = document.getElementById("fechainicio").value;
            var fecha_fin = document.getElementById("fechafin").value;
            var hora = document.getElementById("hora").value;
            var frecuencia = document.getElementById("select_frecuencia").value;
            var json = JSON.stringify(this.objeto_alterno);

            var req = new XMLHttpRequest();

            req.open('GET', './insertar_eventos_api.php?id='+'1'+'&id_tipo='+id_tipo+'&titulo='+titulo+'&desc='+desc+'&fecha_inicio='+fecha_inicio+'&fecha_fin='+fecha_fin+'&hora='+hora+'&frecuencia='+frecuencia+'&obj='+json, true);
            req.onreadystatechange = function (aEvt) {
              if (req.readyState == 4) {
                 if(req.status == 200)
                  dump(req.responseText);
                if(req.responseText == "true"){
                    alert("Evento agregado exitosamente");
                    location.href= '../';
                }
                 else
                  dump("Error loading page\n");
              }
            };
            req.send(null); 
        }
    </script>
</html>