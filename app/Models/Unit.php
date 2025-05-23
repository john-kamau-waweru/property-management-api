<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    
    use HasFactory;

    protected $fillable = ['property_id', 'name', 'rent_amount'];

    // unit belongs to a property
    public function property(){
        return $this->belongsTo(Property::class);
    }
}
