<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'parcel_id',
        'type',
        'pick_up',
        'price'
    ];

    public function parcel()
    {
        return $this->belongsTo(Parcel::class);
    }
}
