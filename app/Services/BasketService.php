<?php

namespace App\Services;

use App\Mail\OrderCreated;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class BasketService
{
    protected $order;

    /**
     * Set the value of order
     *
     * @return  self
     */
    public function setOrder($createOrder = false)
    {
        $orderId = session('orderId');
        if (is_null($orderId) && $createOrder) {
            $this->order = Order::create();
            session(['orderId' => $this->order->id]);
            $this->setUser();
        } else {
            $this->order = Order::findOrFail($orderId);
        }
    }

    /**
     * Get the value of order
     */
    public function getOrder()
    {
        return $this->order;
    }

    public function countAvailable($updateCount = false)
    {
        foreach ($this->order->products as $product) {
            if ($this->getPivotRow($product)->count > $product->count) {
                return false;
            }
            if ($updateCount) {
                $product->count -= $this->getPivotRow($product)->count;
            }
        }

        if ($updateCount) {
            $this->order->products->map->save();
        }
        return true;
    }

    private function setUser()
    {
        if (Auth::check() && !isset($this->order->user_id)) {
            $this->order->user()->associate(Auth::user());
            $this->order->save();
        }
    }

    public function updateOrder($name, $phone, $email)
    {
        if (!$this->countAvailable(true)) {
            return false;
        }
        if ($this->order->status == 0) {
            $this->order->update([
                'name' => $name,
                'phone' => $phone,
                'status' => 1
            ]);
            session()->forget('orderId');
            Mail::to($email)->send(new OrderCreated($name, $this->getOrder()));
            $this->setUser();
        } else {
            session()->flash('danger', 'Ошибка обработки заказа');
        }
        return true;
    }

    protected function getPivotRow($product)
    {
        return $this->order->products()->where('product_id', $product->id)->first()->pivot;
    }

    public function removeProduct($product)
    {
        if ($this->order->products->contains($product)) {
            $orderProduct = $this->getPivotRow($product);
            if ($orderProduct->count < 2) {
                $this->order->products()->detach($product);
            } else {
                $orderProduct->decrement('count');
            }
        }
    }

    public function addProduct($product)
    {
        if ($this->order->products->contains($product)) {
            $orderProduct = $this->getPivotRow($product);
            if ($orderProduct->count + 1 > $product->count) {
                return false;
            }
            $orderProduct->increment('count');
        } else {
            if ($product->count < 1) {
                return false;
            }
            $this->order->products()->attach($product);
        }

        Order::changeFullSum($product->price);

        return true;
    }
}
