@if (count($item->photos) > 0)

<h1 class="text-center mt-4 mb-3">Photos</h1>
	
<div id="photoCarousel" class="carousel slide mb-4" data-ride="carousel">
	<div class="carousel-inner" role="listbox">
		@foreach ($item->photos as $key => $photo)
		<div class="carousel-item {{ $key==0 ? 'active':'' }}">
		  <img class="d-block img-fluid" src="{{ $photo->url() }}" alt="{{ $photo->title }}">
		</div>
		@endforeach
	</div>
	<a class="carousel-control-prev" href="#photoCarousel" role="button" data-slide="prev">
		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
		<span class="sr-only">Previous</span>
	</a>
	<a class="carousel-control-next" href="#photoCarousel" role="button" data-slide="next">
		<span class="carousel-control-next-icon" aria-hidden="true"></span>
		<span class="sr-only">Next</span>
	</a>
</div>

@endif