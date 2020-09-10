@extends('layout')

@section('content')
    <h1>{{ trans('Edit Product') }} </h1>
    <form action="{{ route('products.update', ['id' => $product->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="title">@lang('Title')</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $product['title'] }}">
        </div>
        <div class="form-group">
            <label for="description">@lang('Description')</label>
            <textarea name="description" id="description" cols="30" rows="10"
                      class="form-control">{{ $product['description'] }}</textarea>
        </div>
        <div class="form-group">
            <label for="price">@lang('Price')</label>
            <input type="text" name="price" id="price" class="form-control" value="{{ $product['price'] }}">
        </div>
        <div class="form-group">
            <label for="img">@lang('Image')</label>
            <input type="file" name="img" id="img" class="form-control-file">
        </div>
        <input type="submit" class="btn btn-primary" value="@lang('Submit')">
    </form>

    @foreach ($product->reviews as $review)
        <div class="card">
            <div class="card-body">
                <h3>{{ $review->rating }}</h3>
                <p>{{ $review->comment }}</p>

                <form action="{{ route('reviews.destroy', ['id' => $review->id]) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="@lang('Delete')" class="btn btn-danger">
                </form>
            </div>
        </div>
    @endforeach
@endsection
