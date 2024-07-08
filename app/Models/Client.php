<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $appends = ['category_ids'];

    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    public function getFullName(): string
    {
        return sprintf('%s %s %s', $this->last_name, $this->first_name, $this->middle_name);
    }

    public function getCategoryIdsAttribute()
    {
        return $this->relationLoaded('categories')
            ? $this->categories->pluck('id')->toArray()
            : $this->categories()->pluck('categories.id')->toArray();
    }
}
