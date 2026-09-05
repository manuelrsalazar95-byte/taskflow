<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tareas extends Model
{
    use SoftDeletes;

    protected $table = 'tareas';

    protected $fillable = [
        'categoria_id',
        'usuario_id',
        'titulo',
        'descripcion',
        'estado',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id'); // <--- Apunta a User::class
    }
}