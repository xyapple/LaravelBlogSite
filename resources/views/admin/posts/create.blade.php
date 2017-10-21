@extends('layouts.app')

@section('content')
    <div class='panel panel-defaul'>
        <div class='panel-heading'>

Create a New Post
        </div>
        <div class='panel-body'>
            <form action='post/store' method='post'>
            {{csrf_field()}}
            <div class='form-group'>
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control">
            </div>
            <div class='form-group'>
                <label for="featured">Featured Image</label>
                <input type="file" name="featured" class="form-control">
            </div>
            <div class='form-group'>
                <label for="content">Content</label>
                <textarea name="content" rows="5" cols="5" id="content"  class="form-control"></textarea>
            </div>
            <div class='form-group'>
                <div class='text-center'>
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>

            </div>

            </form>
        </div>
    </div>
@endsection
