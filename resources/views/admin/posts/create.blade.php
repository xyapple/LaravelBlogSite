@extends('layouts.app')

@section('content')

  <div class="panel panel-default">
        @include('admin.includes.errors')
        <div class='panel-heading'>
        Create a New Post
        </div>
        <div class='panel-body'>

            <form action={{route('post.store')}} method='post' enctype="multipart/form-data">
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
                <label for="category">Select Category</label>
                <select name='category_id' id='category' class="form-control">
                    @foreach ($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class='form-group'>
                <label for="tags">Select Tag</label>
                @foreach($tags as $tag)
                   <div class="checkbox">
                         <label><input type="checkbox" name="tags[]" value="{{ $tag->id }}">{{ $tag->tag }}</label>
                   </div>
                @endforeach
            </div>

            <div class='form-group'>
                <label for="content">Content</label>
                <textarea name="content" rows="5" cols="5" id="content"  class="form-control"></textarea>
            </div>
            <div class='form-group'>
                <div class='text-center'>
                    <button class="btn btn-primary" type="submit">Post</button>
                </div>

            </div>

            </form>
        </div>
    </div>
@endsection

@section('styles')
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.css" rel="stylesheet">
@endsection

@section('scripts')
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.js"></script>
<script type="text/javascript">
$(document).ready(function() {
$('#content').summernote();
});

</script>
@endsection
