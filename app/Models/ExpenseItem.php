<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseItem extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $timestamps = false;

    public function operations()
    {
        return $this->hasMany(Operation::class);
    }
}
