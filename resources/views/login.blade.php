@extends('layout')

@section('content')
    <form action="/login" method="post">
        @csrf
        <div class="form-group">
            <label for="username">{{trans('User')}}</label>
            <input type="text" name="username" class="form-control">
        </div>
        <div class="form-group">
            <label for="password">{{trans('Password')}}</label>
            <input type="password" name="password" class="form-control">
        </div>
        <input type="submit" class="btn btn-primary">
    </form>
@endsection
