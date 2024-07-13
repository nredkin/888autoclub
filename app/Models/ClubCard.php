<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClubCard extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    public function client()
    {
        return $this->hasOne(Client::class);
    }

    public function level()
    {
        return $this->hasOne(ClubCardLevel::class);
    }
}
