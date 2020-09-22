<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>{{ config('app.name') }}</title>
</head>
<body>
<div class="card">
    <h1 class="card-header">{{ $order->name }}</h1>
    <div class="card-body">
        <p>{{ __('Contact details') }} : {{ $order->contact }}</p>
        <p>{{ __('Comments') }} : {{ $order->comments }}</p>
        <p>{{ __('Order price:') }} : {{ $order->price }}</p>
        <p>{{ __('Made at') }} : {{ date('d-m-Y', strtotime($order->created_at)) }}</p>
        <p> {{ __('Last update') }} {{ $order->updated_at->diffForHumans() }}</p>
    </div>
</div>
@foreach ($products as $product)
    <div class="row" style="margin: 10px">
        <div class="col-md-3">
            <img src="{{ asset('img/' . $product->id) }}" alt="{{ __('product image') }}" class="img-fluid"
                 style="max-height: 150px; margin-right: 5px">
        </div>
        <div class="col-md-6">
            <h4>{{ $product->title }}</h4>
            <p>{{ $product->description }}</p>
            <p>{{ $product->price }}</p>
        </div>
    </div>
@endforeach
</body>
</html>
