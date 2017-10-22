@extends('layouts.app')

@section('content')
<div class='panel panel-defaul'>
    <div class='panel-heading'>
        Trashed Post
    </div>
    <div class='panel-body'>
        <table class='table table-hover'>
        <thead>
            <th>Image</th>
            <th>Title </th>
            <th>Edit</th>
            <th>Restore</th>
            <th>Destroy</th>
        </thead>
        <tbody>
        @if($posts->count() > 0)
                @foreach ($posts as $post)
                <tr>
                    <td>
                        {{-- use getFeaturedAttribute() in Post.php --}}
                        <img src='{{$post->featured}}' alt='{{$post ->title}} not found' width="90px" height="50px"/>
                    </td>
                    <td>
                        {{$post ->title}}
                    </td>
                    <td>Edit</td>
                    <td>
                        <a href='{{route('post.restore',['id'=>$post->id])}}' class='btn btn-xs btn-success'>
                            Restore
                        </a>

                    </td>
                    <td>
                        <a href='{{route('post.kill',['id'=>$post->id])}}' class='btn btn-xs btn-danger'>
                            Destroy
                        </a>

                    </td>
                </tr>
                @endforeach
        @else
            <th colspan="5" class="text-center">No trash post</th>
        @endif
        </tbody>
        </table>
    </div>

</div>
@endsection
