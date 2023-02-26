<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    
    public $table = "customers";

    protected $fillable = ['fname', 'lname', 'address', 'town', 'city', 'phone', 'user_id', 'cust_img'];


        public function user(){
       return $this->belongsTo('App\Models\User');
    }


    public function motorcycles() {
        return $this->hasMany('App\Models\motorcycle', 'customer_id');
    }
}
