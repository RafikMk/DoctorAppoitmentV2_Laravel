<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    protected $fillable = [
        'patient_id','doctor_id', 'booking_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function patient(){
        return $this->belongsTo(User::class, 'patient_id');
    }
    public function doctor(){
        return $this->belongsTo(User::class, 'doctor_id');
    }
    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }
}
