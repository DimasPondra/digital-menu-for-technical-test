<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    const STATUS_AVAILABLE = 'available';
    const STATUS_NOT_AVAILABLE = 'not available';

    protected $fillable = [
        'name', 'slug', 'description', 'price',
        'status', 'category_id', 'file_id'
    ];

    /** Relationship */
    public function file()
    {
        return $this->belongsTo(File::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
