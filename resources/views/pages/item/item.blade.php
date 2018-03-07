@extends("app")

@section("page-title")
Item - {{ $item->itemName() }} - 
@stop

@section("content")

<main role="main" class="container">
	<div id="msgs"></div>
	
	<div class="card">
		<ol class="breadcrumb no-bottom-margin">
			<li class="breadcrumb-item"><a href="{{ route('list') }}">Items</a></li>
			@if ($item->category)
			<li class="breadcrumb-item"><a href="{{ route('category', [$item->category]) }}">{{ $item->category->name }}</a></li>
			@endif
			<li class="breadcrumb-item active" aria-current="page">{{ $item->itemName() }}</li>
		</ol>
		<div class="card-body">
			<a href="{{ $item->editURL() }}" class="btn btn-primary pull-right">Edit</a>
			<h3 class="card-title">{{ $item->itemName() }}</h3>
			<p class="card-text">{{ $item->description }}</p>
		</div>
		<ul class="list-group list-group-flush">
			<li class="list-group-item"><b>Quantity:</b> {{ $item->quantity }}</li>
			@if ($item->category)
			<li class="list-group-item"><b>Category:</b> <a href="{{ route('category', [$item->category]) }}">{{ $item->category->name }}</a></li>
			@endif
			@if ($item->url)
			<li class="list-group-item"><b>URL:</b> <a href="{{ $item->url }}">{{ $item->url }}</a></li>
			@endif
		</ul>
		<div class="card-body">
			<form method="post" action="{{ route("uploadPhoto", [$item]) }}" enctype="multipart/form-data" class="form-inline validate">
				{!! csrf_field() !!}
				<label for="title" class="h4 mr-2">Upload Photo</label>
				<input type="text" name="title" id="title" placeholder="Title" class="form-control mr-2" data-bvalidator="required">
				<input type="file" name="file" id="file" class="form-control mr-2" data-bvalidator="required">
				<input type="submit" value="Upload Photo" class="btn btn-primary">
				
			</form>
		</div>
	</div>
	
	@include('pages.item.photoCarousel')
</main>

@stop