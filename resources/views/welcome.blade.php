@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="jumbotron jumbotron-fluid">
                <h1 class="display-4 text-center">Postr</h1>
            </div>
            <hr>
            @if ($posts)
                @foreach ($posts as $post)
                    <div class="card">
                        <img src="{{ $post->coverimage }}" class="card-img-top img-fluid w-100" style="height: 250px;" alt="{{ $post->title }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->title }} <span class="text-muted float-right"><small>By: {{ $post->author->name }}</small></span> </h5>
                            <p class="card-text text-truncate">{{ $post->body }}</p>
                            <p class="card-text"><small>Posted On: {{ \Carbon\Carbon::parse($post->created_at)->format('D m, Y') }}</small></p>
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('post',$post->slug) }}" class="btn btn-primary btn-sm mr-1">Read More</a>
                                <button type="button" class="btn btn-light btn-sm float-right">
                                    <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-heart-fill" fill="red" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                                    </svg>
                                    <span class="badge badge-pill badge-light">
                                        {{ $post->likes->count() }}
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="mt-4">
                    {{ $posts->links() }}
                </div>
            @else
                <p>No Post Available</p>
            @endif
        </div>
    </div>
</div>
@endsection
