<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public static function index()
    {
        return Order::all();
    }
    public static function find($ticket)
    {
        $orders = Order::where('ticket', 'like', $ticket)->get();
        return $orders;
    }
    public static function create(
        $cart,
        $ticket,
        $method,
        $name,
        $email,
        $contact,
        $area,
        $address,
        $instructions,
        $via,
        $total,
    ) {
        // Create order
        $order = Order::create([
            'ticket' =>  $ticket,
            'method' =>  $method,
            'name' =>  $name,
            'email' => $email,
            'contact' => $contact,
            'area' =>  $area,
            'address' => $address,
            'instructions' => $instructions,
            'via' => $via,
            'total' => $total,
        ]);
        // Attach Transactions
        $transactions = [];
        foreach ($cart as $item) {
            if (isset($item['selectedOpt']) && $item['selectedOpt']['option'] != 'Check Options') {
                array_push($transactions, [
                    'option' => $item['selectedOpt']['option'],
                    'metric' => null,
                    'value' => $item['selectedOpt']['value'],
                    'quantity' => $item['quantity'],
                    'product_id' => $item['id'],
                    'order_id' => $order->id
                ]);
            } else {
                array_push($transactions, [
                    'option' => null,
                    'metric' => $item['selectedPri']['metric'],
                    'value' => $item['selectedPri']['value'],
                    'quantity' => $item['quantity'],
                    'product_id' => $item['id'],
                    'order_id' => $order->id
                ]);
            }
        }
        $order->transactions()->createMany($transactions);
        return $order;
    }
    public static function update($ticket, $status)
    {
        Order::where('ticket', '=', $ticket)->update(['status' => $status]);
    }
}
