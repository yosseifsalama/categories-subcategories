<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'image', 'is_active', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}