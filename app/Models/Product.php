<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'created_at' => 'datetime:H:i d.m.Y',
    ];

    public function getRouteKeyName()
    {
        return 'code';
    }

    public function category()
    {
        return $this->belongsTo(Category::class)->withDefault();
    }

    public function getPriceForCount(): float
    {
        if (!is_null($this->pivot)) {
            return $this->price * $this->pivot->count;
        }
        return $this->price;
    }

    /*public function setNewAttribute($value)
    {
        $this->attributes['new'] = $value == 'on' ? true : false;
    }

    public function setHitAttribute($value)
    {
        $this->attributes['hit'] = $value == 'on' ? true : false;
    }

    public function setRecommendAttribute($value)
    {
        $this->attributes['recommend'] = $value == 'on' ? true : false;
    }*/

    public function scopeHit($query)
    {
        return $query->where('hit', true);
    }

    public function scopeNew($query)
    {
        return $query->where('new', true);
    }

    public function scopeRecommend($query)
    {
        return $query->where('recommend', true);
    }
}
