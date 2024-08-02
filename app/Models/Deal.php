<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }

    public function operations()
    {
        return $this->hasMany(Operation::class);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
