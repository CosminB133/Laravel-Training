@extends('layout')

@section('content')
    <div class="row" style="margin: 10px">
        <div class="col-md-3">
            <img src="{{ asset('img/' . $product->id) }}" alt="{{ trans('product image') }}" class="img-fluid"
                 style="max-height: 150px; margin-right: 5px">
        </div>
        <div class="col-md-9">
            <h4>{{ $product->title }}</h4>
            <p>{{ $product->description }}</p>
            <p>{{ $product->price }}</p>
        </div>
    </div>

    <form action="/reviews" method="post">
        @csrf
        <div class="form-group">
            <label for="rating">{{ trans('Rating') }}</label>
            <select name="rating" id="rating">
                <option value="1">{{ trans('1') }}</option>
                <option value="2">{{ trans('2') }}</option>
                <option value="3">{{ trans('3') }}</option>
                <option value="4">{{ trans('4') }}</option>
                <option value="5">{{ trans('5') }}</option>
            </select>
        </div>
        <div class="form-group">
            <label for="comments">{{ trans('Comments') }}</label>
            <textarea name="comments" id="comments" cols="30" rows="10" class="form-control"></textarea>
        </div>
        <input type="hidden" value="{{ $product->id }}" name="product_id">
        <input type="submit" class="btn btn-success">
    </form>

    @foreach ($product->reviews as $review)
        <div class="card">
            <div class="card-body">
                <h3>{{ $review->rating }}</h3>
                <p>{{ $review->comment }}</p>
            </div>
        </div>
    @endforeach
@endsection
