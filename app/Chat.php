<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $fillable = [
        'patient_id','doctor_id', 'message','envoye_par'
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function patient(){
        return $this->belongsTo(User::class, 'patient_id');
    }
    public function doctor(){
        return $this->belongsTo(User::class, 'doctor_id');
    }
}
