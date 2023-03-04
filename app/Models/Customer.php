<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'email',
    ];
    
    public function payments(){
        
        return $this->hasMany(Payment::class);
    }

    public function getFullNameAttribute(){
        return "{$this->first_name} {$this->last_name}";
    }
    
}
