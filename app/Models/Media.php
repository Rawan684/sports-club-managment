<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;
    protected $fillable = [
        'sport_id',
        'type',
        'file_name',
        'path_name',
    ];

    public function sport()
    {
        return $this->belongsTo(Sport::class);
    }
}
