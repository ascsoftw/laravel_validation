@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add Story</div>
                <div class="card-body">
                    <form action="{{route('stories.store')}}" method="POST">
                        @csrf

                        @include('story.form')
                        
                        <div>
                            <button class="btn btn-primary">Add New Story</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection