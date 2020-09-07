@extends('layout')

@section('content')
    @foreach($products as $product)
        <div class="row" style="margin: 10px">
            <div class="col-md-3">
                <img src="img/{{$product['id']}}" alt="product image" class="img-fluid"
                     style="max-height: 150px; margin-right: 5px">

            </div>
            <div class="col-md-7">
                <h4>{{ $product['title'] }}</h4>
                <p>{{ $product['description'] }}</p>
            </div>
            <div class="col-md-2">
                <form action="/cart" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $product['id'] }}">
                    <input type="submit" value="Remove" class="btn btn-danger">
                </form>
            </div>
        </div>
    @endforeach

    <form action="orders" method="post">
        @csrf
        <div class="form-group">
            <label for="name">{{trans('Name :')}}</label>
            <input type="text" class="form-control" name="name" id="name">
        </div>

        <div class="form-group">
            <label for="contact">{{trans('Contact details :')}}</label>
            <input type="text" class="form-control" name="contact" id="contact">
        </div>

        <div class="form-group">
            <label for="comments">{{trans('Comments :')}}</label>
            <input type="text" class="form-control" name="comments" id="comments">
        </div>
        <input type="submit" class="btn btn-success" value="{{trans('Submit')}}">
    </form>
@endsection
