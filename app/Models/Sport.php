<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sport extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description'];

    public function facilities()
    {
        return $this->belongsToMany(Facility::class, 'sport_facilities');
    }
    public function dedecated_rooms()
    {
        return $this->hasOne(Dedecated_rooms::class);
    }
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function media()
    {
        return $this->hasMany(Media::class);
    }
}
