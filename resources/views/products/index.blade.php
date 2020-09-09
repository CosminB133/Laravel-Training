@extends('layout')

@section('content')
    @foreach($products as $product)
        <div class="row" style="margin: 10px">
            <div class="col-md-3">
                <img src="{{ asset('img/' . $product->id) }}" alt="{{ trans('product image') }}" class="img-fluid"
                     style="max-height: 150px; margin-right: 5px">
            </div>
            <div class="col-md-6">
                <h4>{{ $product->title }}</h4>
                <p>{{ $product->description }}</p>
                <p>{{ $product->price }}</p>
            </div>
            <div class="col-md-3">
                <a href="{{ url('products/' . $product->id . '/edit') }}" class="btn btn-success">{{ trans('Edit') }}</a>
                <form action=" {{ url('products/' . $product->id )}} " method="post">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="{{ trans('Delete') }}" class="btn btn-danger">
                </form>
            </div>
        </div>
    @endforeach
    <a href=" {{ url('/products/create') }}" class="btn btn-primary">{{ trans('New') }}</a>
@endsection
