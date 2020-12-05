<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{

    public function basket()
    {
        $orderId = session('orderId');
        $order = Order::findOrFail($orderId);
        return view('basket', compact('order'));
    }

    public function basketPlace()
    {
        $orderId = session('orderId');
        $order = Order::findOrFail($orderId);
        return view('order', compact('order'));
    }

    public function basketAdd(Product $product)
    {
        $orderId = session('orderId');
        if (is_null($orderId)) {
            $order = Order::create();
            session(['orderId' => $order->id]);
        } else {
            $order = Order::findOrFail($orderId);
        }

        if ($order->products->contains($product)) {
            $orderProduct = $order->products()->where('product_id', $product->id)->first();
            $orderProduct->pivot->increment('count');
        } else {
            $order->products()->attach($product);
        }

        if (Auth::check() && !isset($order->user_id)) {
            $order->user()->associate(Auth::user());
            $order->save();
        }

        Order::changeFullSum($product->price);

        //session()->flash('success', 'Добавлен товар ' . $product->name);

        return redirect()->route('basket')->withSuccess('Добавлен товар ' . $product->name);
    }

    public function basketRemove(Product $product)
    {
        $orderId = session('orderId');
        $order = Order::findOrFail($orderId);

        if ($order->products->contains($product)) {
            $orderProduct = $order->products()->where('product_id', $product->id)->first();
            if ($orderProduct->pivot->count < 2) {
                $order->products()->detach($product);
            } else {
                $orderProduct->pivot->decrement('count');
            }
        }

        Order::changeFullSum(-$product->price);

        session()->flash('danger', 'Удален товар ' . $product->name);

        return redirect()->route('basket');
    }

    protected function basketConfirm(Request $request)
    {
        $orderId = session('orderId');
        $order = Order::findOrFail($orderId);
        if ($order->status == 0) {
            $order->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'status' => 1
            ]);
            session()->forget('orderId');
            session()->flash('success', 'Ваш заказ принят в обработку');
            if (Auth::check() && !isset($order->user_id)) {
                $order->user()->associate(Auth::user());
                $order->save();
            }
        } else {
            session()->flash('danger', 'Ошибка обработки заказа');
        }
        Order::eraseOrderSum();

        return redirect()->route('index');
    }
}
