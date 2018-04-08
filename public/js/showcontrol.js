/*
	@ Harris Christiansen (code@HarrisChristiansen.com)
	November 2017
	Project: Show Controller - github.com/harrischristiansen/controlshow
*/


var	colors = colors || window.colors,
	hue = hue || window.hue,
	IPAddress = '10.0.0.147',
	APIKey = 'KJbQWzkdkUlhE8276UsldU3Ss7emfXBC4AxuzcBo';

var upO=1, upD=2, upC1=3, upC2=4, downStair=5, downOne=6, downTwo=7;
var lights = [upO, upD, upC1, upC2, downStair, downOne, downTwo]
	upstairs = [upO, upD, upC1, upC2],
	downstairs = [downStair, downOne, downTwo];
var lightElements = {
	".upO": [upO, "Nicky O"],
	".upD": [upD, "Nicky D"],
	".upC1": [upC1, "Nicky C1"],
	".upC2": [upC2, "Nicky C2"],
	".downStair": [downStair, "Downstairs Stair Light"],
	".downOne": [downOne, "Downstairs Lamp One"],
	".downTwo": [downTwo, "Downstairs Lamp 2"],
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
	$("#act_upstairs").spectrum({
		chooseText: "Set",
		showAlpha: true,
		showPalette: true,
		palette: color_palette,
		change: function(color) {
			setRoom(upstairs, color);
			displayMessage("Set upstairs lights to "+color.toHexString());
			$("#act_kitchen").css('background-color', color.toHexString());
		}
	});
	$("#act_downstairs").spectrum({
		chooseText: "Set",
		showAlpha: true,
		showPalette: true,
		palette: color_palette,
		change: function(color) {
			setRoom(downstairs, color);
			displayMessage("Set downstairs lights to "+color.toHexString());
			$("#act_living").css('background-color', color.toHexString());
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
