<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
      'transaction_id',
      'item_id',
      'user_id',
      'note',
      'price',
      'qty',
      'sub_total',
    ];

    public function item(){
        return $this->belongsTo(Item::class,'item_id');
    }

    public function item_all(){
        return $this->belongsTo(Item::class,'item_id')->withTrashed();
    }
}
