var computed = false;
var decimal = 0;

// ||--------------Funkcje Pomocnicze--------------||

function convert(entityform, from, to){
	var convertfrom = from.selectedIndex;
	var convertto = to.selectedIndex;
	entityform.display.value = (entityform.input.value * from[convertfrom].value / to[convertto].value);
}

function addChar(input, character){
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

// ||--------------Czyszczenie Zegara--------------||
function clear(form){
	form.input.value = 0;
	form.display.value = 0;
	decimal = 0;
}

// ||--------------Zmiana Tła Strony--------------||
function changeBackground(number){
	if(number === null){
		number = "01"
	}
	document.body.style.backgroundImage ='url(img/tla/'+number+".jpg)";
	localStorage.setItem('background', number);
}

// ||--------------Funkcje Zegara--------------||
function gettheDate(){
	Todays = new Date();
	TheDate = "" + (Todays.getMonth()+1) +" / "+ Todays.getDate() + " / " +(Todays.getYear()-100);
	$("#data").html(TheDate);
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
	var timeValue = ""
    
    if(hours > 12){
        timeValue+=(hours-12)
    }
    else{
        timeValue+=(hours)
    }
	timeValue += (minutes < 10) ? ":0"+minutes : ":" + minutes
	timeValue += (seconds < 10) ? ":0"+seconds : ":" + seconds
	timeValue += (hours >= 12) ? "PM" : "AM"
	$("#zegarek").html(timeValue);
	timerID = setTimeout("showtime()",1000);
	timerRunning = true;
}

// ||--------------Wklejenie Strony Do Szablonu--------------||

function loadsite(lista){
    var linki = "";
    lista.forEach(function(val){
        linki += '<li class="przybliz"><a href="?id='+val[0]+'">'+val[1]+'</a></li>\n';
    })
    console.log(linki);
	$.get('html/template.html', function(data){
		if (!$('.tresc').html()) {
            var content = $('body').html();
			$('body').html(data);
            $('.strony').html(linki);
            $('.tresc').html(content);
            startclock();
        }
	});
	$(window).scroll(function(){
		$("#cover").css({"margin-top": ($(window).scrollTop()) + "px"});
	});
	changeBackground(localStorage.getItem('background'));
	startclock();
}

// ||--------------Operacje Na Rozmiarze--------------||
var $on = false;
var $db = false;
document.addEventListener("click", function (event) {
    if($db){return};
    $db = true;
    // ||--------------Przybliżenie Obrazka--------------||
	if(event.target.tagName === "IMG") {
		var $img = $(event.target);
		if($on === false){
			$img.attr("id", "picked");
			$("#picked").animate({
				width: "75%"
			},1500);
			$("#picked").css({
				"z-index": '10',
				"position": 'relative'
			});
			$("#cover").css('background-color', 'rgba(0, 0, 0, 0.5)');
			$("#cover").css("z-index", '5');
			$on = true;
		} else{
            // ||--------------Przyciemnianie Tła--------------||
			$("#picked").animate({
				width: "50%"
			},1500);
            $on = false;
			$("#picked").css({
				"z-index": '10',
				"position": 'static'
			});
			$("#cover").css('background-color', 'rgba(0, 0, 0, 0)');
			$("#cover").css("z-index", '-1');
			$("#picked").removeAttr("id");
		}
	}
	else{
		$("#picked").animate({
			width: "50%"
		},1500);
		$("#picked").css({
			"z-index": '10',
			"position": 'static'
		});
		$("#cover").css('background-color', 'rgba(0, 0, 0, 0)');
		$("#cover").css("z-index", '-1');
		$on = false;
		$("#picked").removeAttr("id");
	};
    setTimeout(function(){$db = false},1500);
});