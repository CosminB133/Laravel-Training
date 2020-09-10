@extends('layout')

@section('content')
    <div class="card">
        <h1 class="card-header">{{ $order->name }}</h1>
        <div class="card-body">
            <p>@lang('Contact details') : {{ $order->contact }}</p>
            <p>@lang('Comments') : {{ $order->comments }}</p>
            <p>@lang('Order price:') : {{ $order->price }}</p>
            <p>@lang('Made at') : {{ date('d-m-Y', strtotime($order->created_at)) }}</p>
            <p> @lang('Last update') {{ $order->updated_at->diffForHumans() }}</p>
        </div>
    </div>
    @foreach($order->products as $product)
        <div class="row" style="margin: 10px">
            <div class="col-md-3">
                <img src="{{ asset('img/' . $product->id) }}" alt="@lang('product image')" class="img-fluid"
                     style="max-height: 150px; margin-right: 5px">
            </div>
            <div class="col-md-6">
                <h4>{{ $product->title }}</h4>
                <p>{{ $product->description }}</p>
                <p>{{ $product->pivot->price }}</p>
            </div>
        </div>
    @endforeach
@endsection
