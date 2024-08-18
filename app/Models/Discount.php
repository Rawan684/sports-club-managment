<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;
    protected $fillable = [
        'offer_id',
        'subscription_plan_id',
        'discount',
    ];

    public function offer()
    {
        return $this->belongsTo(Offers::class);
    }

    public function subscriptionPlan()
    {
        return $this->belongsTo(Subsecription_Plans::class);
    }
}
