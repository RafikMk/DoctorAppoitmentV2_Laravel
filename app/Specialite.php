<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specialite extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];
    public function users()
    {
        return $this->hasMany(User::class, 'specialite', 'specialite');
    }
}
