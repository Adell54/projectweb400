<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class Cart extends Model
{
    protected $table = 'cart';
 
   protected $fillable = ['user_id'];

   // In App\Models\Cart.php
public function cartItems()
{
    return $this->hasMany(Cart_items::class);
}

}
