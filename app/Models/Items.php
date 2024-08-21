<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    use HasFactory, HasUuids;

    public $incrementing = false;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id'); 
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
