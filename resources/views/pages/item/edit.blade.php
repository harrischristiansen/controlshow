@extends("app")

@section("page-title")
{{ $item->id==0 ? "Add New Item" : "Edit Item: " }} - 
@stop

@section("content")

<main role="main" class="container">
	<div id="msgs"></div>
	
	<form method="post" action="{{ $item->postURL() }}" class="card validate">
		{!! csrf_field() !!}
		<div class="card-header">
			<b>{{ $item->id==0 ? "Add New Item" : "Edit Item: " }}</b>{{ $item->name }}
		</div>
		<div class="card-body">
			<h3 class="card-title form-inline">
				<b>Item Name:</b> <input type="text" name="name" placeholder="Name" class="form-control form-control-lg" data-bvalidator="required" data-bvalidator-msg="Item Name Required" value="{{ $item->name }}">
			</h3>
			<b>Description:</b> <textarea name="description" class="form-control">{{ $item->description }}</textarea>
		</div>
		<ul class="list-group list-group-flush">
			<li class="list-group-item"><b>Quantity:</b> <input type="text" name="quantity" placeholder="Quantity" class="form-control" data-bvalidator="number" value="{{ $item->quantity }}"></li>
			<li class="list-group-item"><b>Category:</b> <input type="text" name="category" placeholder="Category" class="form-control categoriesTypeahead" value="{{ $item->category ? $item->category->name : "" }}"></li>
			<li class="list-group-item"><b>URL:</b> <input type="text" name="url" placeholder="URL" class="form-control" data-bvalidator="url" value="{{ $item->url }}"></li>
		</ul>
		<div class="card-body">
			<input type="submit" value="Save" class="btn btn-primary">
		</div>
	</form>
	
	@include('pages.item.photoCarousel')
</main>

@stop