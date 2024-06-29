<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
      'user_id',
      'transaction_number',
      'total_price',
      'status_pesanan',
      'status_pembayaran',
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
