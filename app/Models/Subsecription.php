<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Subsecription extends Model
{
    use HasFactory;
    protected $fillable = [
        'subscription_plan_id',
        'start_date',
        'end_date',
        'status',
        'suspension_reason',
    ];
    public function subsecriptionPlan()
    {
        return $this->belongsTo(Subsecription_plans::class);
    }
    public function user()
    {
        return $this->hasMany(User::class);
    }
}
