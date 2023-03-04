<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{

    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'customer_id',
        'transaction_id',
        'amount',
        'reference_id',
        'comments',
        'status'
    ];
    public function customer(){

        return $this->belongsTo(Customer::class);
    }
    
}
