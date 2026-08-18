<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;
    protected $table  = 'usuarios';
    protected $primaryKey = 'id';
    protected $fillable = ['user_name', 'password'];
    protected $hidden = ['password'];

    protected $casts = [
        'password' => 'hashed',

    ];

    public function tareas()
    {
        return $this->hasMany(Tareas::class, 'usuario_id');
    }
}
