<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;
    function rel_to_customer(){
        return $this->belongsTo(customerlogin::class,'customer_id');
    }

}
