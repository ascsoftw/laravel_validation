@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Story</div>

                <div class="card-body">
                    <form action="{{route('stories.update', [$story])}}" method="POST">
                        @csrf
                        @method('PUT')

                        @include('story.form')

                        <div>
                            <button class="btn btn-primary">Update Story</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection