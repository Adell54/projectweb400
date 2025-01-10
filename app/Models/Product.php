<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
 
    protected $table = 'products';
 
    protected $fillable = ['name', 'image','quantity','price','category', 'description', 'enabled','category_id'];
    
}
