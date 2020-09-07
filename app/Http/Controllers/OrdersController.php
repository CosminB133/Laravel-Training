<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{

    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        $validatedData = $this->validate(
            $request,
            [
                'name' => 'required',
                'comment' => 'required',
                'contact' => 'required',
            ]
        );
        $order = new Order();
        $order['name'] = $validatedData['name'];
        $order['comment'] = $validatedData['comment'];
        $order['contact'] = $validatedData['contact'];
        $order->save();

        return redirect('index');
    }

    public function show($id)
    {
        //
    }


}
