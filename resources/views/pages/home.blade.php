@extends("app")

@section("content")

<main role="main" class="container">
	<div id="msgs"></div>
	<div class="jumbotron text-center lightControls">
		<h1>Brightness</h1><br>
		<a class="btn btn-danger btn-xl act_setBright" href="#" data-brightness="25">Min</a>
		<a class="btn btn-orange btn-xl" href="#" id="act_decrease">Decrease</a>
		<a class="btn btn-teal btn-xl" href="#" id="act_increase">Increase</a>
		<a class="btn btn-success btn-xl act_setBright" href="#" data-brightness="255">Max</a>
	</div>
	<div class="jumbotron text-center lightControls">
		<a class="btn btn-primary btn-xl" href="#" id="act_kitchen">Kitchen</a>
		<a class="btn btn-primary btn-xl" href="#" id="act_living">Living</a>
		<a class="btn btn-primary btn-xl" href="#" id="act_lamp">Lamp</a>
		<a class="btn btn-primary btn-xl" href="#" id="act_bath">Bath</a>
		<br><br>
		@include('elements/lightmap')
	</div>
</main>

@stop