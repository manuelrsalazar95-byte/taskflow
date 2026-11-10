<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categoria extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'categoria';

    protected $primaryKey = 'id';

    protected $fillable = ['name', 'user_id'];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tareas()
    {
        return $this->hasMany(Tarea::class, 'categoria_id');
    }
}
