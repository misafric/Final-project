<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Country;
use App\Models\Article;
use App\Models\OrderStatusLog;


class Order extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }

    public function order_status_logs()
    {
        return $this->hasMany(OrderStatusLog::class);
    }
}
