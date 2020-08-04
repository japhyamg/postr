@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add Post</div>

                <div class="card-body">
                    <form action="{{ route('post.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                          <label for="title">Title</label>
                          <input type="text" class="form-control" id="title" name="title">
                        </div>
                        <div class="form-group">
                          <label for="body">Body</label>
                          <textarea class="form-control" id="body" rows="3" name="body"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
