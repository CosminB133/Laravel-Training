@extends('layout')

@section('content')
    @foreach ($orders as $order)
        <div class="card" style="margin: 10px">
            <h1 class="card-header">{{ $order->name }}</h1>
            <div class="card-body">
                <p>{{ trans('Contact details') }} : {{ $order->contact }}</p>
                <p>{{ trans('Comments') }} : {{ $order->comments }}</p>
                <p>{{ trans('Order price:') }} : {{ $order->price }}</p>
                <p>{{ trans('Made at') }} : {{ date('d-m-Y', strtotime($order->created_at)) }}</p>
                <p>{{ trans('Last update') }} {{ $order->updated_at->diffForHumans() }}</p>
                <a href="{{ url('/orders/' . $order->id ) }}" class="btn btn-primary">{{ trans('Show') }}</a>
            </div>
        </div>
    @endforeach
@endsection
