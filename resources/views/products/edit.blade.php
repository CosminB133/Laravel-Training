@extends('layout')

@section('content')
    <h1>{{ trans('Edit Product') }} </h1>
    <form action="/products/{{ $product['id'] }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">{{ trans('Title') }}</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $product['title'] }}">
        </div>
        <div class="form-group">
            <label for="description">{{ trans('Description') }}</label>
            <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{ $product['description'] }}</textarea>
        </div>
        <div class="form-group">
            <label for="price">{{ trans('Price') }}</label>
            <input type="text" name="price" id="price" class="form-control" value="{{ $product['price'] }}">
        </div>
        <div class="form-group">
            <label for="img">{{ trans('Image') }}</label>
            <input type="file" name="img" id="img" class="form-control-file" >
        </div>
        <input type="hidden" name="_method" value="patch">
        <input type="submit" class="btn btn-primary" value="{{ trans('Submit') }}">
    </form>
@endsection
