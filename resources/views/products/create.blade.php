@extends('layout')

@section('content')
    <h1>@lang('Add Product')</h1>
    <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">@lang('Title')</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}">
        </div>
        <div class="form-group">
            <label for="description">@lang('Description')</label>
            <textarea name="description" id="" cols="30" rows="10" class="form-control">{{ old('description') }}</textarea>
        </div>

        <div class="form-group">
            <label for="price">@lang('Price')</label>
            <input type="text" name="price" id="price" class="form-control" value="{{ old('price') }}">
        </div>

        <div class="form-group">
            <label for="img">@lang('Image')</label>
            <input type="file" name="img" id="img" class="form-control-file" >
        </div>

        <input type="submit" class="btn btn-primary" value="@lang('Submit')">

    </form>
@endsection
