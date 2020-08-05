@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }} <a href="{{ route('post.create') }}" class="btn btn-info btn-sm float-right">Add Post</a></div>

                <div class="card-body">
                    <h3>My Posts</h3>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if ($posts)
                        @foreach ($posts as $post)
                            <div class="card">
                                <img src="{{ $post->coverimage }}" class="card-img-top w-100" style="height: 250px;" alt="{{ $post->title }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $post->title }}</h5>
                                    <p class="card-text text-truncate">{{ $post->body }}</p>
                                    <div class="d-flex justify-content-start">
                                        <a href="#" class="btn btn-primary btn-sm mr-1">Read More</a>
                                        <a href="{{ route('post.edit', $post->id) }}" class="btn btn-warning btn-sm mr-1">Edit</a>
                                        <form action="{{ route('post.destroy',$post->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="mt-4">
                            {{ $posts->links() }}
                        </div>
                    @else
                        <p>You have no post</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
