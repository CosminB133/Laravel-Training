@extends('layout')

@section('content')
    @foreach ($orders as $order)
        <div class="card" style="margin: 10px">
            <h1 class="card-header">{{ $order->name }}</h1>
            <div class="card-body">
                <p>@lang('Contact details') : {{ $order->contact }}</p>
                <p>@lang('Comments') : {{ $order->comments }}</p>
                <p>@lang('Order price:') : {{ $order->price }}</p>
                <p>@lang('Made at') : {{ date('d-m-Y', strtotime($order->created_at)) }}</p>
                <p>@lang('Last update') {{ $order->updated_at->diffForHumans() }}</p>
                <a href="{{ route('orders.show', ['order' => $order->id]) }}" class="btn btn-primary">@lang('Show')</a>
            </div>
        </div>
    @endforeach
@endsection
