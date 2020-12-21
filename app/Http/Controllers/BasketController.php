<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Services\BasketService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{
    private $basketService;

    public function __construct(BasketService $basketService)
    {
        $this->basketService = $basketService;
    }

    public function basket()
    {
        $this->basketService->setOrder();
        $order = $this->basketService->getOrder();
        return view('basket', compact('order'));
    }

    public function basketPlace()
    {
        $this->basketService->setOrder();
        $order = $this->basketService->getOrder();
        if (!$this->basketService->countAvailable()) {
            session()->flash('danger', "Товар недоступен для заказа в полном объеме");
            return redirect()->route('basket');
        }
        return view('order', compact('order'));
    }

    public function basketAdd(Product $product)
    {
        $this->basketService->setOrder(true);
        $result = $this->basketService->addProduct($product, true);

        if ($result) {
            session()->flash('success', "Добавлен товар $product->name");
        } else {
            session()->flash('danger', "Товар $product->name в большем 
                количестве недоступен для заказа");
        }

        return redirect()->route('basket');
    }

    public function basketRemove(Product $product)
    {
        $this->basketService->setOrder();
        $this->basketService->removeProduct($product);

        Order::changeFullSum(-$product->price);

        session()->flash('danger', "Удален товар $product->name");

        return redirect()->route('basket');
    }

    protected function basketConfirm(Request $request)
    {
        $email = Auth::check() ? $request->user()->email : $request->email;
        $this->basketService->setOrder();
        if ($this->basketService->updateOrder($request->name, $request->phone, $email)) {
            Order::eraseOrderSum();
            session()->flash('success', 'Ваш заказ принят в обработку');
        } else {
            session()->flash('danger', "Товар недоступен для заказа в полном объеме");
            return redirect()->route('basket');
        }

        return redirect()->route('index');
    }
}
