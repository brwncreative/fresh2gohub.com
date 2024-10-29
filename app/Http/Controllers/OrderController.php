<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Get all orders
     * @return mixed
     */
    public static function index($chunk = 0)
    {
        $chunks =  Order::all()->reverse()->chunk(5);

        if ($chunks->has($chunk)) {
            return $chunkpkg = [
                'size' => sizeof($chunks),
                'position' => $chunk,
                'chunk' => $chunks[$chunk]
            ];
        } else {
            return $chunkpkg = [
                'size' => 0,
                'position' => $chunk,
                'chunk' => []
            ];
        }
    }
    /**
     * Find specific order
     * @param mixed $ticket
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function find($ticket)
    {
        return Order::where('ticket', 'like', $ticket)->get();
    }
    /**
     * Get user order history
     * @param mixed $id
     * @return mixed
     */
    public static function getOrderHistory($id)
    {
        return Order::where('user_id', '=', $id)->get();
    }
    /**
     * Summary of filterOrders
     * @param mixed $status
     * @param mixed $stage
     * @param mixed $chunk
     * @return array
     */
    public static function filterOrders($status = '?', $stage = '?', $chunk = 0)
    {
        $DBcall =
            'return \App\Models\Order::' .
            ($status == "?" ? "" : "where('paid', '=',  $status )")
            . ($status != '?' ? ($stage != '?' ? '->' : '') : '')
            . ($stage == '?' ? '' : "where('stage', 'LIKE', '%$stage%')");
        $DBcall .= '->get()->chunk(5);';
        
        similar_text($DBcall, 'return \App\Models\Order::->get()->chunk(5);', $percent);
        if ($percent != 100) {
            $chunks = eval($DBcall);
            if ($chunks->has($chunk)) {
                return $chunkpkg = [
                    'size' => sizeof($chunks),
                    'position' => $chunk,
                    'chunk' => $chunks[$chunk]
                ];
            } else {
                return $chunkpkg = [
                    'size' => $chunk,
                    'position' => $chunk,
                    'chunk' => null
                ];
            }
        } else {
            return $chunkpkg = [
                'size' => $chunk,
                'position' => $chunk,
                'chunk' => null
            ];
        }
    }
    /**
     * Create order
     * @param mixed $cart
     * @param mixed $ticket
     * @param mixed $method
     * @param mixed $name
     * @param mixed $email
     * @param mixed $contact
     * @param mixed $area
     * @param mixed $address
     * @param mixed $instructions
     * @param mixed $via
     * @param mixed $total
     * @param mixed $user_id
     * @return TModel
     */
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
        $user_id = '?'
    ) {
        $user = function () use ($user_id) {
            if ($user_id != '?') {
                return $user_id;
            }
        };
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
            'user_id' => $user()
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
    /**
     * Update Order
     * @param mixed $ticket
     * @param mixed $paid
     * @param mixed $stage
     * @return void
     */
    public static function update($ticket, $paid = '?', $stage = '?')
    {
        if ($paid == true) {
            Order::where('ticket', '=', $ticket)->update(['paid' => 1]);
        } else {
            Order::where('ticket', '=', $ticket)->update(['paid' => 0]);
        }
        if ($stage != '?') {
            Order::where('ticket', '=', $ticket)->update(['stage' => $stage]);
        }
    }
    /**
     * Delete an Order from the DB
     * @param mixed $id
     * @return void
     */
    public static function deleteOrder($id){
        DB::table('orders')->delete($id);
    }
}
