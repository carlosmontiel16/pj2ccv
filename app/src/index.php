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
	
		  <button id="btn_minus" class="btn btn-primary" onclick="minusYear()">-</button><label id="idyear">2021</label><button id="btn_plus" class="btn btn-primary" onclick="plusYear()">+</button>
		  <br>
		  <br>
		  <button id="btn_minus" class="btn btn-primary" onclick="minusMonth()">-</button><label id="idmonth">Mayo</label><button id="btn_plus" class="btn btn-primary" onclick="plusMonth()">+</button>
		  <div hidden="true"  id="monthnumber">4</div>
	

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
  initCalendar(null, null);

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
function initCalendar(year, month){
	var number_days_month = 0;
	var dates;
	if(year !== null && month !== null){
		dates = new Date(year, month)
	}
	else{
		dates = new Date();
	}
	
	var year = dates.getFullYear();
	var month = dates.getMonth();
	number_days_month = getDaysInMonth(month, year);	
	console.log(number_days_month + 1 );
	var day_one_of_month = new Date(year, month, 1).getDay();
	var html = '';
	month = month+1;
	var req = new XMLHttpRequest();
	var fetched_dates;
	var arr_of_fetched = new Array();

            req.open('GET', './Event/get_dates.php?month='+month+'&year='+year, true);
            req.onreadystatechange = function (aEvt) {
              if (req.readyState == 4) {
                 if(req.status == 200)
                  dump(req.responseText);
                if(req.responseText !== "false"){
                    fetched_dates = JSON.parse(req.responseText);

                    for (var key in fetched_dates) {
				    if (fetched_dates.hasOwnProperty(key)) {
				        var s = fetched_dates[key].substring(fetched_dates[key].length-2)
				        arr_of_fetched.push(parseFloat(s));
				    }
				}
				for(var i = 0, j = 1; i <= number_days_month+day_one_of_month; i++ ){
		if(i==0 || i==7 || i ==7*2 || i==7*3 || i==7*4 || i==7*5){
			html = html + '<tr class="week">';
		}
		if(i>= day_one_of_month){
	
			  if(arr_of_fetched.includes(j)){
			  	console.log(j);
			  	 html =  html +'<td class="dayTd" id="rw_'+j+'" onmouseover="showAddButton('+year +','+ month+','+ j+ ')" onmouseout="hideAddButton('+year +','+ month+','+ j+ ')"><div class="dayMonth">'+j+'</div><div class="row"><img onclick="addEvent('+year +','+ month+','+ j+ ')"src="./img/addicon.png" id="img_'+year+month+j+'" style="position: relative; width: 30%; height:30%; left: 15%; top:0%; display:none"></img><img onclick="viewDayEvents('+year +','+ month+','+ j+ ')" src="./img/visibility.png" id="img_v'+year+month+j+'" style="position: relative; width: 30%; height:30%; left: 30%; top:0%; display:none"></img></div><div class="row" style=" position: relative; left: 20px; top:20px; border-radius: 90%; width: 9px; height:9px; background:aqua; border: 1px solid blue; "></></td>';
			  }
			  else{
			  	 html =  html +'<td class="dayTd" id="rw_'+j+'" onmouseover="showAddButton('+year +','+ month+','+ j+ ')" onmouseout="hideAddButton('+year +','+ month+','+ j+ ')"><div class="dayMonth">'+j+'</div><div class="row"><img onclick="addEvent('+year +','+ month+','+ j+ ')"src="./img/addicon.png" id="img_'+year+month+j+'" style="position: relative; width: 30%; height:30%; left: 15%; top:0%; display:none"></img><img onclick="viewDayEvents('+year +','+ month+','+ j+ ')" src="./img/visibility.png" id="img_v'+year+month+j+'" style="position: relative; width: 30%; height:30%; left: 30%; top:0%; display:none"></img></div></td>';
			  }                
			
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
                 else
                  dump("Error loading page\n");
              }
            };
            req.send(null); 


	

	


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

	<!-- script para refrescar el inicio -->
	<script type="text/javascript">
	function minusYear(){
		var n = document.getElementById("idyear").innerHTML;
		n = parseFloat(n);

		document.getElementById("idyear").innerHTML = n - 1;
		callCalendar();
	}	
	function plusYear(){
		var n = document.getElementById("idyear").innerHTML;
		n = parseFloat(n);
		document.getElementById("idyear").innerHTML = n+1;
		callCalendar();

	}
	function minusMonth(){
		var month_number = document.getElementById("monthnumber").innerHTML;
		var month_string = document.getElementById("idmonth");

		monthnumber = parseFloat(month_number);

		monthnumber = monthnumber -1;
		if(monthnumber<0){
			monthnumber = monthnumber+1;
		}
		document.getElementById("monthnumber").innerHTML = monthnumber;
		month_string.innerHTML = this.numberToMonth(monthnumber);

		callCalendar();

	}
	function plusMonth(){
		var month_number = document.getElementById("monthnumber").innerHTML;
		var month_string = document.getElementById("idmonth");

		monthnumber = parseFloat(month_number);

		monthnumber = monthnumber +1;
		if(monthnumber>11){
			monthnumber = monthnumber-1;
		}

		document.getElementById("monthnumber").innerHTML = monthnumber;
		month_string.innerHTML = numberToMonth(monthnumber);

		callCalendar();

	}
	function callCalendar(){
		var n = document.getElementById("idyear").innerHTML;
		n = parseFloat(n);
		var month_number = document.getElementById("monthnumber").innerHTML;
		monthnumber = parseFloat(month_number);
		initCalendar(n, monthnumber);
	}
	function numberToMonth(p){
				switch(p){
			case 0:
			return "Enero";
			break;
			case 1:
			return "Febrero";
			break;
			case 2:
			return "Marzo";
			break;
			case 3:
			return "Abril";
			break;
			case 4:
			return "Mayo";
			break;
			case 5:
			return "Junio";
			break;
			case 6:
			return "Julio";
			break;
			case 7:
			return "Agosto";
			break;
			case 8:
			return "Septiembre";
			break;
			case 9:
			return "Octubre";
			break;
			case 10:
			return "Noviembre";
			break;
			case 11:
			return "Diciembre";
			break;
		}
	}
	</script>

</html>