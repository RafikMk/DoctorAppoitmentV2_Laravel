<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];
    // hasMany dans la classe Role pour définir que chaque rôle peut appartenir à plusieurs utilisateurs.
    public function users()
    {
        return $this->hasMany(User::class, 'role_id', 'id');
    }
}
