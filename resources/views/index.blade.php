@extends('layout')

@section('content')
    @foreach ($products as $product)
        <div class="row" style="margin: 10px">
            <div class="col-md-3">
                <img src="img/{{ $product->id }}" alt="{{ trans('product image') }}" class="img-fluid"
                     style="max-height: 150px; margin-right: 5px">

            </div>
            <div class="col-md-6">
                <h4>{{ $product->title }}</h4>
                <p>{{ $product->description }}</p>
            </div>
            <div class="col-md-3">
                <form action="/cart" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $product->id }}">
                    <input type="submit" value="{{ trans('Add') }}" class="btn btn-success">
                </form>
            </div>
        </div>
    @endforeach
@endsection
