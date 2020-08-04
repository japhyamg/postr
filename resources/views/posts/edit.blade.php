@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Post</div>

                <div class="card-body">
                    <form action="{{ route('post.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" value="{{ $post->title ?? '' }}" name="title" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                        </div>
                        <div class="form-group">
                            <label for="body">Body</label>
                            <textarea class="form-control @error('body') is-invalid @enderror" id="body" rows="3" name="body" required>{{ $post->body ?? '' }}</textarea>
                            @error('body')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="coverimage">Cover Image</label>
                            <input type="file" name="coverimage" id="coverimage" class="form-control-file @error('coverimage') is-invalid @enderror">
                            <br>
                            <img src="{{ $post->coverimage }}" class="img-thumbnail w-50" alt="">
                            @error('coverimage')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
