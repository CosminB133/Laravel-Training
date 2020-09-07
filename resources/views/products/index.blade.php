@extends('layout')

@section('content')
    @foreach($products as $product)
        <div class="row" style="margin: 10px">
            <div class="col-md-3">
                <img src="img/{{ $product['id'] }}" alt="product image" class="img-fluid"
                     style="max-height: 150px; margin-right: 5px">

            </div>
            <div class="col-md-6">
                <h4>{{ $product['title'] }}</h4>
                <p>{{ $product['description'] }}</p>
            </div>
            <div class="col-md-3">
                <a href="products/{{ $product['id'] }}/edit" class="btn btn-success">Edit</a>
                <form action="products/{{ $product['id'] }}" method="post">
                    @csrf
                    <input type="hidden" name="_method" value="delete">
                    <input type="submit" value="Delete" class="btn btn-danger">
                </form>
            </div>
        </div>
    @endforeach
@endsection
