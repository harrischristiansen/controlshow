@extends("app")

@section("page-title")
List - 
@stop

@section("content")

<main role="main" class="container">
	<div id="msgs"></div>
	<div class="table-responsive">
		@include('pages.item.table')
	</div>
</main>

@stop