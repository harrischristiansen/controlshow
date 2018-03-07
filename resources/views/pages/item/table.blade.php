<table class="table table-striped table-links sortable">
	<thead>
		<tr>
			<th>Photo</th>
			<th>Name</th>
			<th>Quantity</th>
			<th>Category</th>
			<th>URL</th>
		</tr>
	</thead>
	<tbody>
		@forelse ($items as $item)
		<tr>
			@if (count($item->photos) > 0)
			<td><img src="{{ $item->photos->first()->iconURL() }}" alt="{{ $item->photos->first()->title }}" class="img-thumbnail" style="height: 100px;"></td>
			@else
			<td>No Photo</td>
			@endif
			<td><a href="{{ route('item', [$item]) }}">{{ $item->name }}</a></td>
			<td>{{ $item->quantity }}</td>
			<td>{{ $item->category ? $item->category->name : "" }}</td>
			<td>{{ $item->url }}</td>
		</tr>
		@empty
		<tr>
			<td></td>
			<td>No Items Found</td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		@endforelse
	</tbody>
</table>