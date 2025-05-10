<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{

    use HasFactory;

    // Property belongs to landlord and a landlord can have many properties
    protected $fillable = ['user_id', 'name', 'city'];

    // landlord that owns the property
    public function user(){
        return $this->belongsTo(User::class);
    }

    // A property can have many units
    public function units(){
        return $this->hasMany(Unit::class);
    }
}
