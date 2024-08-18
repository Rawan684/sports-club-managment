<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dedecated_rooms extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function sport()
    {
        return $this->belongsToMany(Sport::class);
    }
}
