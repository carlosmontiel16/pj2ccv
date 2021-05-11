<!DOCTYPE html>
<html>
<head>
	<title>Proyecto 2</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
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
			top: -45px;
		}
	</style>
</head>
<body class="bg-light text-dark">
	<div style="width: 80%; height: 100%; margin-left: 10%; margin-right: 10%; background-color: Lavender;">
		<h4>¡Bienvenido!</h4>
		<h3 id="idhour"> </h3>
		<center>
		<div class="btn-group"  role="group" aria-label="Basic example">
		  <button type="button" onclick="inicio()" class="btn btn-primary">Inicio</button>
		  <button type="button" class="btn btn-primary">Administracion de Calendario</button>
		  <button type="button" class="btn btn-primary">Reportes</button>
		</div>

		<br><br>
		<div class="calendar">
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
			<tbody>
				
				<tr class="week">
					<td class="dayTd">
						<div class="dayMonth">1</div>
					</td>
					<td class="dayTd">
						<div class="dayMonth">2</div>
					</td>
					<td class="dayTd">
						<div class="dayMonth">3</div>
					</td>
					<td class="dayTd">
						<div class="dayMonth">4</div>
					</td>
					<td class="dayTd">
						<div class="dayMonth">5</div>
					</td>
					<td class="dayTd">
						<div class="dayMonth">6</div>
					</td>
					<td class="dayTd">
						<div class="dayMonth">7</div>
					</td>
				</tr>
			</tbody>
			</table>
		</div>
		</center>
	</div>


</body>

<!-- Init handlers-->

<script type="text/javascript">
	window.onload = function() {
  initHour();
  initCalendar();

};
function initHour(){
	var headerhour = document.getElementById("idhour");
	headerhour.innerHTML = getClientDate();
	setTimeout(initHour , 1000);
}

function refreshHour(){

}
</script>
<!-- Get current date-->
<script type="text/javascript"> 


function getClientDate(){
var currentdate = new Date(); 
var datetime = "" + currentdate.getDate() + "/"
            + (currentdate.getMonth()+1)  + "/" 
            + currentdate.getFullYear() + " "  
            + currentdate.getHours() + ":"  
            + currentdate.getMinutes() + ":" 
            + currentdate.getSeconds();
           return datetime;
}
</script>

<!-- function handlers -->

<script type="text/javascript">
	function inicio(){
		location.href = "./index.php"
	}


</script>



<!-- calendar handlers -->
<script type="text/javascript">	
function getDaysInMonth(month,year) {
 	return new Date(year, month, 0).getDate();

}
function initCalendar(){
	var number_days_month = 0;
	var d = new Date();
	var year = d.getFullYear();
	var month = d.getMonth();
	number_days_month = getDaysInMonth(month, year);
	console.log(number_days_month);	
}

</script>
</html>