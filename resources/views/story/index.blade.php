@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">
		<h2>Stories</h2>
		<a href="{{ route('stories.create') }}">Add New Story</a>
	</div>

	@foreach( $stories as $story )
		<div class="row">
			<div class="col">{{ $story->subject }}</div>
			<div class="col">{{ $story->body }}</div>
			<div class="col">{{ ( $story->active == 1) ? 'Yes' : 'No' }}</div>
			<div class="col"> 
					<a href="{{ route('stories.edit', [$story ]) }}">Edit</a> 
			</div>
		</div>
	@endforeach
</div>
@endsection