<?php

namespace App\Http\Controllers;

use App\Models\Product;
use function Psy\debug;
use App\Models\Category;
use App\Models\Subscription;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\FilterRequest;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(FilterRequest $filterRequest)
    {
        //Log::info($filterRequest->ip());
        // Log::channel('ips')->info($filterRequest->ip());
        \Debugbar::info($filterRequest->ip());
        $params = [];
        $query = Product::with('category');
        if ($filterRequest->filled('price_from')) {
            $query->where('price', '>=', $filterRequest->price_from);
            $params[] = ['price_from' => $filterRequest->price_from];
        }
        if ($filterRequest->filled('price_to')) {
            $query->where('price', '<=', $filterRequest->price_to);
            $params[] = ['price_to' => $filterRequest->price_to];
        }
        foreach (['new', 'hit', 'recommend'] as $field) {
            if ($filterRequest->has($field)) {
                $query->$field();
                $params[] = [$field => $filterRequest->$field];
            }
        }

        $products = $query->paginate(6);
        return view('index', compact('products', 'params'));
    }

    public function categories()
    {
        $categories = Category::get();
        return view('categories', compact('categories'));
    }

    public function category(Category $category)
    {
        return view('category', compact('category'));
    }

    public function product(Category $category, $code)
    {
        $product = Product::withTrashed()->where('code', $code)->first();
        if ($product)
            return view('product', compact('product'));
        abort(404);
    }

    public function subscribe(Request $request, Product $product)
    {
        if ($request->filled('email')) {
            $request->validate([
                'email' => 'email'
            ]);
            $email = $request->email;
        } else {
            if (Auth::check()) {
                $email = $request->user()->email;
            } else {
                return back()->withErrors(['email' => 'Введите email']);
            }
        }
        $product->subscriptions()->create(compact('email'));
        return back()->withSuccess('Спасибо, мы сообщим вам о поступлении товара');
    }
}
