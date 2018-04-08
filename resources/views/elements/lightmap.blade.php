<?
$sceneID = bin2hex(openssl_random_pseudo_bytes(10));

$DEFAULT_LAYOUT = [
	"upO" =>		["circleLight",	"#0000FF"],
	"upD" =>		["circleLight",	"#0000FF"],
	"upC1" =>		["circleLight",	"#0000FF"],
	"upC2" => 		["circleLight",	"#0000FF"],
	"downStair" => 	["circleLight",	"#0000FF"],
	"downOne" =>	["circleLight",	"#0000FF"],
	"downTwo" => 	["circleLight",	"#0000FF"],
];

$CLASSNAME_TO_LIGHTNAME = [
	"upO" =>		"Nicky O",
	"upD" =>		"Nicky D",
	"upC1" =>		"Nicky C1",
	"upC2" => 		"Nicky C2",
	"downStair" => 	"Downstairs Stair Light",
	"downOne" =>	"Downstairs Lamp One",
	"downTwo" => 	"Downstairs Lamp Two",
];
?>

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