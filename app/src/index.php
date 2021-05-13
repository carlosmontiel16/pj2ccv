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
				top: -35px;
		}
		.dayTd:hover{
			background-color: lightgray;
		}
		.bgcontainer{
			background-color: #e9ecef;
		}
	</style>
</head>
<body class="bgcontainer">
	<div style="width: 80%; height: 100%; margin-left: 10%; margin-right: 10%; background-color: white;">
		<div  class="bgcontainer">
			<h4>¡Bienvenido!</h4>
		<h3 id="idhour"> </h3>
		</div>
		
		<center>
		<div class="btn-group" style="background-color: #e9ecef; "  role="group" aria-label="Basic example">
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
			<tbody id="init_calendar_body_table">
				
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
	var d = new Date(year, month, 0).getDate();
 	return d;

}
function getFirstDay(month, year){
	var d = new Date().getDate();
 	return d;
}
function initCalendar(){
	var number_days_month = 0;
	var dates = new Date();
	var year = dates.getFullYear();
	var month = dates.getMonth();
	number_days_month = getDaysInMonth(month, year);	
	console.log(number_days_month + 1 );
	var day_one_of_month = new Date(year, month, 1).getDay();
	var html = '';
	month = month+1;
	for(var i = 0, j = 1; i <= number_days_month+day_one_of_month; i++ ){
		if(i==0 || i==7 || i ==7*2 || i==7*3 || i==7*4 || i==7*5){
			html = html + '<tr class="week">';
		}
		if(i>= day_one_of_month){
			
			 html =  html +'<td class="dayTd" id="rw_'+j+'" onmouseover="showAddButton('+year +','+ month+','+ j+ ')" onmouseout="hideAddButton('+year +','+ month+','+ j+ ')"><div class="dayMonth">'+j+'</div><div class="row"><img onclick="addEvent('+year +','+ month+','+ j+ ')"src="./img/addicon.png" id="img_'+year+month+j+'" style="position: relative; width: 30%; height:30%; left: 15%; top:0%; display:none"></img><img onclick="viewDayEvents('+year +','+ month+','+ j+ ')" src="./img/visibility.png" id="img_v'+year+month+j+'" style="position: relative; width: 30%; height:30%; left: 30%; top:0%; display:none"></img></div></td>';
			 j++
		}
		else{
			html = html + '<td class="dayTd"></td>';
		}

		if(i==6){
			html = html + '</tr>';
		}
		
	}

	var table = document.getElementById("init_calendar_body_table");
	table.innerHTML=html;


}

</script>


<!-- Scrip para crear eventos -->


<script type="text/javascript">
	function showAddButton(a, m, d){

		var img = document.getElementById("img_"+a+m+d);
		img.style.display = 'block';

		var img2 = document.getElementById("img_v"+a+m+d);
		img2.style.display = 'block';

		
	}
	function hideAddButton(a, m, d){
		var img = document.getElementById("img_"+a+m+d);
		img.style.display = 'none';

		var img2 = document.getElementById("img_v"+a+m+d);
		img2.style.display = 'none';

	}

	function addEvent(a, m, d){
		if(d<10){
			d = "0"+d;
		}
		if(m<10){
			m = "0"+m;
		}
		location.href = "./Event/insert_event.php?year="+a+"&month="+m+"&day="+d;

	}
	function viewDayEvents(a, m, d){
		console.log("Ver eventos del dia");
		location.href = "verevento.php?year="+a+"&month="+m+"&day="+d;

	}
</script>
</html>