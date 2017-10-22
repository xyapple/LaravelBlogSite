@extends('layouts.app')

@section('content')
    <div class='panel panel-defaul'>

        @include('admin.includes.errors')
        <div class='panel-heading'>
         Edit post: {{ $post->title }}
        </div>
        <div class='panel-body'>

            <form action={{route('post.update',['id' => $post->id])}} method='post' enctype="multipart/form-data">
            {{csrf_field()}}
            <div class='form-group'>
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" value="{{$post->title}}">
            </div>
            <div class='form-group'>
                <label for="featured">Featured Image</label>
                <input type="file" name="featured" class="form-control">
            </div>
            <div class='form-group'>
                <label for="category">Select Category</label>
                <select name='category_id' id='category' class="form-control">
                    @foreach ($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class='form-group'>
                <label for="content">Content</label>
                <textarea name="content" rows="5" cols="5" id="content"  class="form-control">{{$post->content}}</textarea>
            </div>
            <div class='form-group'>
                <div class='text-center'>
                    <button class="btn btn-primary" type="submit">Update Post</button>
                </div>

            </div>

            </form>
        </div>
    </div>
@endsection
