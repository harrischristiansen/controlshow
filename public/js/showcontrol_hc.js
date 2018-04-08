/*
	@ Harris Christiansen (code@HarrisChristiansen.com)
	November 2017
	Project: Show Controller - github.com/harrischristiansen/controlshow
*/


var	colors = colors || window.colors,
	hue = hue || window.hue,
	IPAddress = '10.3.0.177',
	APIKey = 'd5orxbetHKF46FCV1wBmnFTVNSkGQWMSjwNOHu2i';

var windowLight = 5, couch = 6, wall = 7, mid = 8, tv = 9, strip = 18
	lamp_mid = 10, lamp_top = 11, lamp_btm = 12,
	bath_main = 16, bath_guest = 17,
	fridge = 4, sink = 19, oven = 20, bar = 21, cabinet = 26, table=27;
var lights = [cabinet, sink, oven, bar, fridge, mid, couch, strip, tv, table, windowLight, wall, lamp_top, lamp_mid, lamp_btm, bath_main, bath_guest]
	kitchen = [sink, oven, bar, fridge, cabinet],
	living = [mid, couch, tv, windowLight, strip, wall, table],
	lamp = [lamp_top, lamp_mid, lamp_btm],
	bath = [bath_main, bath_guest];
var lightElements = {
	".sinkLight": [sink, "sink"],
	".ovenLight": [oven, "oven"],
	".barLight": [bar, "bar"],
	".fridgeLight": [fridge, "fridge"],
	".cabinetLight": [cabinet, "cabinet"],
	".midLight": [mid, "middle"],
	".couchLight": [couch, "couch"],
	".tvLight": [tv, "tv"],
	".windowLight": [windowLight, "window"],
	".wallLight": [wall, "wall"],
	".tableLight": [table, "table"],
	".deskLight": [strip, "tv desk"],
	".lampTop": [lamp_top, "lamp top"],
	".lampMid": [lamp_mid, "lamp middle"],
	".lampBtm": [lamp_btm, "lamp bottom"],
	".bathLight": [bath_main, "main bathroom"],
	".guestLight": [bath_guest, "guest bathroom"],
};
var color_palette = ['transparent', '#000001', '#FF0000', '#904000', '#ffb400', '#ff00b0', '#bb00ff', '#0000FF', '#00FF00', '#8183ff', '#e1e2fb', '#f9bbbb', '#f9bbf1']

// ================ Setup ============== //

$(document).ready(documentReady);

function documentReady() {
	setupPage();

	// Configure Hue
	hue.setIpAndApiKey(IPAddress, APIKey);
	hue.setLightIDs(lights);

	try {
		loadCurrentLights();
		displayMessage("Connected!");
	} catch (e) {
		displayMessage("Not Connected!", isFailure=true);
	}
}

function setupPage() {
	createButtonListeners();
	createColorpickers();
}

var isBusy = false;

function createButtonListeners() {
	// ================ Nav Bar ============== //

	$("#act_on").click(function() {
		hue.turnOnAll();
		$(".lightControls").slideDown();
		displayMessage("Lights On!");
	});
	$("#act_off").click(function() {
		hue.turnOffAll();
		$(".lightControls").slideUp();
		displayMessage("Lights Off!");
	});
	$("#act_flash").click(function() {
		if (isBusy) {
			return false;
		}
		displayMessage("Lights Flashed!");
		isBusy = true;
		for (var i in lights) {
			setTimeout(flashLight, 260*i, lights[i]);
		}
		setTimeout(function() {
			isBusy = false;
		}, 260*lights.length + 2000);
	});
	$("#act_noEffects").click(function() {
		hue.removeEffectAll();
		displayMessage("Light effects canceled!");
	});
	$("#act_colorloop").click(function() {
		hue.colorloopAll();
		displayMessage("Lights set to colorloop!");
	});

	// ================ Brightness ============== //

	$("#act_decrease").click(function() {
		if (isBusy) {
			return false;
		}
		isBusy = true;

		hue.dimAll(50);
		displayMessage("Brightness decreased!");
		setTimeout(function() {
			isBusy = false;
			loadCurrentLights();
		}, 1000);
	});
	$("#act_increase").click(function() {
		if (isBusy) {
			return false;
		}
		isBusy = true;

		hue.brightenAll(50);
		displayMessage("Brightness increased!");
		setTimeout(function() {
			isBusy = false;
			loadCurrentLights();
		}, 1000);
	});
	$(".act_setBright").click(function(evt) {
		brightness = parseInt(evt.target.getAttribute('data-brightness'));
		hue.setAllBrightness(brightness);
		displayMessage("Brightness set to "+parseInt(brightness/255*100)+"%!");
		loadCurrentLights();
	});
}

// ================ Scenes ============== //

function setRoom(room, color) {
	for (var i in room) {
		setLightColor(lightElements[getElementClass(room[i])], color);
		setElementColor(room[i], "#"+color);
	}
}

$(".setScene").click(setScene);
function setScene(evt) {
	var sceneID = evt.target.getAttribute('data-scene');
	$("#"+sceneID+" > div").each(function(i) {
		classname = "."+$(this).attr('class').split(' ')[1];
		light = lightElements[classname];
		color = $(this).spectrum("get");
		setLightColor(light, color);
	});
	displayMessage("Set scene: "+evt.target.innerText);
}

// ================ Light Status ============== //

function loadCurrentLights() {
	$(".currentLights > div").each(function(i) {
		classname = "."+$(this).attr('class').split(' ')[1];
		light = lightElements[classname];
		color = "#"+hue.getColorHex(light[0]);
		alpha = hue.getBrightnessValue(light[0]) / 255;
		$(this).css("background-color", color);
		$(this).spectrum("set", colors.hexToRGBAString(color, alpha));
	});
}

// ================ Light Assignment ============== //

function setColor(color) {
	classname = "."+$(this).attr("class").split(' ')[1];
	light = lightElements[classname];

	setLightColor(light, color, $(this));
	setElementColor($(this), color.toHexString());
}

function setLightColor(light, color, element=null) {
	if (color._a == 0) { // Transparent = Ignore
		return false;
	}
	color_hex = "";
	if (typeof color === 'string' || color instanceof String) {
		color_hex = color;
	} else {
		color_hex = color.toHexString()
	}

	if (color_hex == "#000000" || color_hex == "#000001") {
		hue.turnOff(light[0]);
	} else {
		if (element != null) {
			bgcolor = element.css('background-color');
			if ((bgcolor == "rgb(0, 0, 0)" || bgcolor == "rgb(0, 0, 1)")) {
				hue.turnOn(light[0]);
			}
		} else {
			hue.turnOn(light[0]);
		}
		setTimeout(setLightToHex, 50, light[0], color_hex.substring(1, 7), Math.ceil(color._a*255));
		if (element != null) {
			displayMessage("Set "+light[1]+" light to <span style=\"color: "+color_hex+";\">"+color_hex+"</span>");
		}
	}
}

function setLightToHex(lightID, colorHex, brightness=null) {
	hue.setColor(lightID, colorHex);
	if (brightness != null && brightness > 1 && brightness <= 255) {
		hue.setBrightness(lightID, brightness);
	}
}

function flashLight(light) {
	hue.turnOff(light);
	flashLightElement(light);
	setTimeout(function() {
		hue.turnOn(light);
	}, 1200);
}

// ================ HTML Light Element Assignment ============== //

function getElementClass(light) {
	var classname = "";
	for (var i in lightElements) {
		if (lightElements[i][0] == light) {
			classname = i;
			break;
		}
	}
	return classname
}

function setElementColor(light, color) {
	if (Number.isInteger(light)) {
		light = getElementClass(light)
	}

	if (typeof light === 'string' || light instanceof String) {
		$(light).css('background-color', color);
	} else {
		light.css('background-color', color);
	}
}

function flashLightElement(light) {
	if (Number.isInteger(light)) {
		light = getElementClass(light)
	}

	element = $(".currentLights > "+light);
	bgcolor = element.css('background-color');
	setElementColor(element, '#000000');
	setTimeout(setElementColor, 1400, element, bgcolor);
}

// ================ Color Pickers ============== //

function createColorpickers() {
	$("#act_kitchen").spectrum({
		chooseText: "Set",
		showAlpha: true,
		showPalette: true,
		palette: color_palette,
		change: function(color) {
			setRoom(kitchen, color);
			displayMessage("Set kitchen lights to "+color.toHexString());
			$("#act_kitchen").css('background-color', color.toHexString());
		}
	});
	$("#act_living").spectrum({
		chooseText: "Set",
		showAlpha: true,
		showPalette: true,
		palette: color_palette,
		change: function(color) {
			setRoom(living, color);
			displayMessage("Set living room lights to "+color.toHexString());
			$("#act_living").css('background-color', color.toHexString());
		}
	});
	$("#act_lamp").spectrum({
		chooseText: "Set",
		showAlpha: true,
		showPalette: true,
		palette: color_palette,
		change: function(color) {
			setRoom(lamp, color);
			displayMessage("Set lamp lights to "+color.toHexString());
			$("#act_lamp").css('background-color', color.toHexString());
		}
	});
	$("#act_bath").spectrum({
		chooseText: "Set",
		showAlpha: true,
		showPalette: true,
		palette: color_palette,
		change: function(color) {
			setRoom(bath, color);
			displayMessage("Set bathroom lights to "+color.toHexString());
			$("#act_bath").css('background-color', color.toHexString());
		}
	});

	for (var i in lightElements) {
		$(i).each(function(index) {
			lightColor = $(this).attr("data-initial-color");
			$(this).spectrum({
				color: lightColor,
				chooseText: "Set",
				showAlpha: true,
				showPalette: true,
				palette: color_palette,
				change: setColor,
			});
		});
	}
}

// ================ Display Messages ============== //

function displayMessage(msg, isFailure=false) {
	if (isFailure) {
		var element = $('<div class="alert alert-danger" role="alert">'+msg+"</div>").appendTo('#msgs').delay(2200).slideUp(300);
	} else {
		var element = $('<div class="alert alert-success" role="alert">'+msg+"</div>").appendTo('#msgs').delay(2200).slideUp(300);
	}
	setTimeout(removeElement, 10000, element);
}

function removeElement(element) {
	element.remove();
}
