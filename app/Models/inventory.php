<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class inventory extends Model
{
    use HasFactory;

    function rel_to_pro(){
        return $this->belongsTo(product::class,'product_id');
    }
    function rel_to_color(){
        return $this->belongsTo(color::class,'color_id');
    }
    function rel_to_size(){
        return $this->belongsTo(size::class,'size_id');
    }
}
