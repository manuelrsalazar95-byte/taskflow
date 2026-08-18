<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tareas extends Model
{
    use HasFactory, SoftDeletes;    
    protected $table = 'tareas';
    protected $primaryKey = 'id';
    protected $fillable = ['titulo', 'descripcion', 'categoria_id', 'usuario_id', 'estado'];

    protected $casts = [
        'estado' => 'boolean',
        'categoria_id' => 'integer',
        'usuario_id' => 'integer'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
