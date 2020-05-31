@php
$sceneID = bin2hex(openssl_random_pseudo_bytes(10));

$DEFAULT_LAYOUT = [
	"sinkLight" =>		["circleLight",	"#0000FF"],
	"ovenLight" =>		["circleLight",	"#0000FF"],
	"barLight" =>		["circleLight",	"#0000FF"],
	"fridgeLight" => 	["circleLight",	"#0000FF"],
	"cabinetLight" => 	["rectLight",	"#0000FF"],
	"midLight" =>		["circleLight",	"#0000FF"],
	"couchLight" => 	["circleLight",	"#0000FF"],
	"tvLight" =>		["circleLight",	"#0000FF"],
	"windowLight" => 	["circleLight",	"#0000FF"],
	"wallLight" =>		["circleLight",	"#0000FF"],
	"tableLight" => 	["squareLight",	"#0000FF"],
	"deskLight" =>		["rectLight",	"#0000FF"],
	"lampTop" =>		["circleLight",	"#0000FF"],
	"lampMid" =>		["circleLight",	"#0000FF"],
	"lampBtm" =>		["circleLight",	"#0000FF"],
	"bathLight" =>		["circleLight",	"#0000FF"],
	"guestLight" => 	["circleLight",	"#0000FF"],
];

$CLASSNAME_TO_LIGHTNAME = [
	"sinkLight" =>		"Sink",
	"ovenLight" =>		"Oven",
	"barLight" =>		"Bar",
	"fridgeLight" => 	"Fridge",
	"cabinetLight" => 	"Cabinet",
	"midLight" =>		"Middle",
	"couchLight" => 	"Couch",
	"tvLight" =>		"TV",
	"windowLight" => 	"Window",
	"wallLight" =>		"Wall",
	"tableLight" => 	"Table",
	"deskLight" =>		"Under Desk",
	"lampTop" =>		"Lamp Top",
	"lampMid" =>		"Lamp Mid",
	"lampBtm" =>		"Lamp Bottom",
	"bathLight" =>		"Main Bath",
	"guestLight" => 	"Guest Bath",
];

@endphp

<div class="roomLayout {{ isset($currentLights) ? 'currentLights' : 'sceneMap' }}" id="<? echo $sceneID; ?>">
	@php
	if(!isset($layout)) {
		$layout = $DEFAULT_LAYOUT;
	}
	@endphp
	@foreach ($layout as $classname => $details)
		<div class="{{ $details[0] }} {{ $classname }}" style="background-color: {{ $details[1] }}" data-initial-color="{{ $details[1] }}" title="{{ $CLASSNAME_TO_LIGHTNAME[$classname] }}"></div>
	@endforeach
</div>
@isset($title)
<br>
<button class="btn btn-info setScene" data-scene="<? echo $sceneID; ?>"><? echo $title; ?></button>
@endisset
<br><br>