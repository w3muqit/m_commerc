<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class billingdetails extends Model
{
    use HasFactory;

    function rel_to_country(){
        return $this->BelongsTo(country::class,'country_id');
    }
}
