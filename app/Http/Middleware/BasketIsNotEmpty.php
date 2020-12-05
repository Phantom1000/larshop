<?php

namespace App\Http\Middleware;

use App\Models\Order;
use Closure;
use Illuminate\Http\Request;

class BasketIsNotEmpty
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $orderId = session('orderId');
        /*if (is_null($orderId)) {
            $order = Order::create();
            session(['orderId' => $order->id]);
            $request->session()->flash('danger', 'Ваша корзина пуста');
            return redirect()->route('index');
        } else {
            $order = Order::findOrFail($orderId);
            if ($order->products->count() == 0) {
                $request->session()->flash('danger', 'Ваша корзина пуста');
                return redirect()->route('index');
            }
        }*/


        if (!is_null($orderId) && Order::getFullSum() > 0) {
            return $next($request);
        }

        $request->session()->flash('danger', 'Ваша корзина пуста');
        return redirect()->route('index');
    }
}
