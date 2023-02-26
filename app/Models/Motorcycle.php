<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Motorcycle extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $fillable = ['customer_id', 'model', 'motorcycle_img'];


    public function customers() {
        return $this->belongsTo('App\Models\Customer', 'customer_id');
   }

}
