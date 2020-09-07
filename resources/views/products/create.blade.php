@extends('layout')

@section('content')
    <h1>Add Products</h1>
    <form action="/products" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
        </div>

        <div class="form-group">
            <label for="price">Price</label>
            <input type="text" name="price" id="price" class="form-control" >
        </div>

        <div class="form-group">
            <label for="img">Image</label>
            <input type="file" name="img" id="img" class="form-control-file" >
        </div>

        <input type="submit" class="btn btn-primary">

    </form>
@endsection
