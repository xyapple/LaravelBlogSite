@extends('layouts.app')

@section('content')
<div class='panel panel-defaul'>
    <div class='panel-heading'>
        Public Posts
    </div>
    <div class='panel-body'>
        <table class='table table-hover'>
        <thead>
            <th>Image</th>
            <th>Title </th>
            <th>Edit</th>
            <th>Trash</th>
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
                <td>
                    <a href='{{route('post.edit',['id'=>$post->id])}}' class='btn btn-xs btn-info'>
                        Edit
                    </a>

                </td>
                <td>
                    <a href='{{route('post.delete',['id'=>$post->id])}}' class='btn btn-xs btn-danger'>
                        Trash
                    </a>

                </td>
            </tr>
            @endforeach
        @else
            <th colspan="5" class="text-center">No public post</th>
        @endif
        </tbody>
        </table>
    </div>

</div>
@endsection
