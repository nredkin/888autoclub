<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function servicePrices()
    {
        return $this->hasMany(ServicePrice::class);
    }

    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }

    public function operations()
    {
        return $this->hasMany(Operation::class);
    }
}
