<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mechanic extends Model
{
    use HasFactory;


     public $table = "mechanics";

    protected $fillable = ['fname', 'lname', 'address', 'town', 'city', 'phone', 'user_id', 'mechanic_img'];


        public function user(){
       return $this->belongsTo('App\Models\User');
    }
}
