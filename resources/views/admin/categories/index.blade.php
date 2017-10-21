@extends('layouts.app')

@section('content')
<table class='table table-hover'>
<thead>
    <th>Category Name</th>
    <th>Edit </th>
    <th>Delete</th>
</thead>
<tbody>
    @foreach ($categories as $category)
    <tr>
        <td>
            {{$category ->name}}
        </td>
    </tr>
    @endforeach
</tbody>
</table>
@endsection
