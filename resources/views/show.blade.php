@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <img src="{{ $post->coverimage }}" class="card-img-top img-fluid w-100" style="height: 250px;" alt="{{ $post->title }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $post->title }} <span class="text-muted float-right"><small>By: {{ $post->author->name }}</small></span> </h5>
                    <p class="card-text">{{ $post->body }}</p>
                    <p class="card-text"><small>Posted On: {{ \Carbon\Carbon::parse($post->created_at)->format('D m, Y') }}</small></p>
                    <div class="d-flex justify-content-end">
                        <like-button post-id={{ $post->id }} like-count={{ $post->likes->count() }}></like-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
