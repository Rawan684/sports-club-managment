<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'subscription_id',
        'payment_date',
        'amount',
    ];

    public function subsecription()
    {
        return $this->belongsTo(Subsecription::class);
    }

    public function scopeFilterByMemberId($query, $userId)
    {
        return $query->whereHas('subscription.user', function ($query) use ($userId) {
            $query->where('id', $userId);
        });
    }

    public function scopeFilterByPaymentAmount($query, $paymentAmount)
    {
        return $query->where('payment_amount', $paymentAmount);
    }
}
