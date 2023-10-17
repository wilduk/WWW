var computed = false;
var decimal = 0;

function convert (entityform, from, to){
	convertfrom = from.selectedIndex;
	convertto = to.selectedIndex;
	entryform.display.value = (entryform.input.value * from[convertfrom].value / to[convertto].value);
}

function addChar (input, character){
	if((character=='.' && decimal=="0") || character!="."){
		(input.value == "" || input.value=="0") ? input.value = character : input.value += character
		convert(input.form,input.form.measure1,input.form.measure2)
		computed = true;
		if (character=='.'){
			decimal = 1;
		}
	}
}

function openvothcom(){
	window.open("","Display widow","toolbar=no,directories=no,menubar=no");
}

function clear(form){
	form.input.value = 0;
	form.display.value = 0;
	decimal = 0;
}

function changeBackground(number){
	document.body.style.backgroundImage ='url(obrazki/tla/'+number+".jpg)";
}

function gettheDate(){
	Todays = new Date();
	TheDate = "" + (Todays.getMonth()+1) +" / "+ Todays.getDate() + " / " +(Todays.getYear()-100);
	document.getElementById("data").innerHTML = TheDate;
}

var timerID = null;
var timerRunning = false;

function stopclock(){
	if(timerRunning){
		clearTimeout(timerID);
	}
	timerRunning = false;
}

function startclock(){
	stopclock();
	gettheDate();
	showtime();
}

function showtime(){
	var now = new Date();
	var hours = now.getHours();
	var minutes = now.getMinutes();
	var seconds = now.getSeconds();
	var timeValue = ""+ (hours >12) ? hours-12 : hours
	timeValue += (minutes < 10) ? ":0"+minutes : ":" + minutes
	timeValue += (seconds < 10) ? ":0"+seconds : ":" + seconds
	timeValue += (hours >= 12) ? "PM" : "AM"
	document.getElementById("zegarek").innerHTML = timeValue;
	timerID = setTimeout("showtime()",1000);
	timerRunning = true;
}