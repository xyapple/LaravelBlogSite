@extends('layouts.app')

@section('content')
<div class='panel panel-defaul'>
    <div class='panel-body'>
        <table class='table table-hover'>
        <thead>
            <th>Image</th>
            <th>Title </th>
            <th>Edit</th>
            <th>Trash</th>
        </thead>
        <tbody>
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
                    {{-- <a href='{{route('category.edit',['id'=>$category->id])}}' class='btn btn-xs btn-info'>
                        Edit
                    </a> --}}
                    Edit
                </td>
                <td>
                    <a href='{{route('post.delete',['id'=>$post->id])}}' class='btn btn-xs btn-danger'>
                        Trush
                    </a>

                </td>
            </tr>
            @endforeach
        </tbody>
        </table>
    </div>

</div>
@endsection
