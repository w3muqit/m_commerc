<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class wishlist extends Model
{
    use HasFactory;

    function rel_to_wish(){
        return $this->belongsTo(product::class,'product_id');
    }
}
