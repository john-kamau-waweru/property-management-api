<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //
    protected $fillable = [
        'lease_id', 'amount', 'due_date', 'paid_date', 'status'
    ];

    public function lease()
    {
        return $this->belongsTo(Lease::class);
    }
}
