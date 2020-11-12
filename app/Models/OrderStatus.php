<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderStatusLog;

class OrderStatus extends Model
{
    use HasFactory;

    public function order_status_logs()
    {
        return $this->hasMany(OrderStatusLog::class);
    }
}
