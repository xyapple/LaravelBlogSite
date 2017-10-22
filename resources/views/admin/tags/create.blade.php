@extends('layouts.app')

@section('content')
    <div class="panel panel-default">

        @include('admin.includes.errors')
        <div class='panel-heading'>
        Create a New Tag
        </div>
        <div class='panel-body'>

            <form action={{route('tag.store')}} method='post'>
            {{csrf_field()}}
            <div class='form-group'>
                <label for="tag">Tag</label>
                <input type="text" name="tag" class="form-control">
            </div>

            <div class='form-group'>
                <div class='text-center'>
                    <button class="btn btn-primary" type="submit">Create Tag</button>
                </div>

            </div>

            </form>
        </div>
    </div>
@endsection
