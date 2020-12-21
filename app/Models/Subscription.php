<?php

namespace App\Models;

use Illuminate\Support\Facades\Mail;
use App\Mail\SendSubscriptionMessage;
use Illuminate\Database\Eloquent\Model;
use App\Notifications\SubscriptionNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subscription extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email'
    ];

    public function scopeActiveByProductId($query, $productId)
    {
        return $query->where('status', 0)->where('product_id', $productId);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public static function sendEmailBySubscription(Product $product)
    {
        $subscriptions = self::activeByProductId($product->id)->get();

        foreach ($subscriptions as $subscription) {
            $subscription->status = 1;
            $subscription->save();
            Mail::to($subscription->email)->send(new SendSubscriptionMessage($product));
        }
    }
}
