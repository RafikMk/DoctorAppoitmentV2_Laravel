<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    protected $fillable = [
    'booking_id','medicine','ailment','symptoms','procedure','feedback','signature','date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
 
    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }
}
