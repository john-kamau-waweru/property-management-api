<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    //
    protected $fillable = ['first_name', 'last_name', 'email', 'phone'];

    public function leases()
    {
        return $this->hasMany(Lease::class);
    }
}
