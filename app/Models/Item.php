<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id',
        'name',
        'image',
        'price',
    ];

    protected $with = 'category';

    /**
     * @return BelongsTo
     */
    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }
}
