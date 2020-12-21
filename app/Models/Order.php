<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SebastianBergmann\CodeUnit\FunctionUnit;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('count')->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function calculateFullSum()
    {
        $sum = 0;
        foreach ($this->products()->withTrashed()->get() as $product) {
            $sum += $product->getPriceForCount();
        }
        return $sum;
    }

    public static function changeFullSum($changeSum)
    {
        $sum = self::getFullSum() + $changeSum;
        session(['full_order_sum' => $sum]);
    }

    public static function getFullSum()
    {
        return session('full_order_sum', 0);
    }

    public static function eraseOrderSum()
    {
        session()->forget('full_order_sum');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function saveOrder($name, $phone)
    {
        /*$this->name = $name;
        $this->phone = $phone;
        $this->status = 1;
        $this->sum = $this->getFullSum();
        $this->save();*/

        /*$skus = $this->skus;
        $this->save();

        foreach ($skus as $skuInOrder) {
            $this->skus()->attach($skuInOrder, [
                'count' => $skuInOrder->countInOrder,
                'price' => $skuInOrder->price,
            ]);
        }

        session()->forget('order');
        return true;*/
    }
}
