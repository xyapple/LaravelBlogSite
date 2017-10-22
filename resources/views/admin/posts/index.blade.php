@extends('layouts.app')

@section('content')
<div class='panel panel-defaul'>
    <div class='panel-body'>
        <table class='table table-hover'>
        <thead>
            <th>Image</th>
            <th>Title </th>
            <th>Edit</th>
            <th>Delete</th>
        </thead>
        <tbody>
            @foreach ($posts as $post)
            <tr>
                <td>
                    Image
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
                    {{-- <a href='{{route('category.delete',['id'=>$category->id])}}' class='btn btn-xs btn-danger'>
                        Delete
                    </a> --}}
                    Delete
                </td>
            </tr>
            @endforeach
        </tbody>
        </table>
    </div>

</div>
@endsection
