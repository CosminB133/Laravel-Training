@extends('layout')

@section('content')
    @foreach ($products as $product)
        <div class="row" style="margin: 10px">
            <div class="col-md-3">
                <img src="{{ asset('img/' . $product->id) }}" alt="@lang('product image')" class="img-fluid"
                     style="max-height: 150px; margin-right: 5px">

            </div>
            <div class="col-md-6">
                <h4>{{ $product->title }}</h4>
                <p>{{ $product->description }}</p>
                <p>{{ $product->price }}</p>
            </div>
            <div class="col-md-3">
                <form action="{{ route('cart') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $product->id }}">
                    <input type="submit" value="@lang('Add')" class="btn btn-success">
                    <a href="{{ route('products.show', ['product' => $product->id]) }}"
                       class="btn btn-primary">@lang('Show')</a>
                </form>
            </div>
        </div>
    @endforeach
@endsection
