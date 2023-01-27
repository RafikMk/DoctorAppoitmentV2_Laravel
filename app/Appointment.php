<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Appointment extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public function doctor()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function getDateAttribute($value)
    {
        return date("Y-m-d", strtotime($value));
    }
    
}
