<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;


class Categoria extends Model
{
    use SoftDeletes;
    protected $table = 'categoria';
    protected $primaryKey = 'id';
    protected $fillable = ['name'];

    public function tareas()
    {
        return $this->hasMany(Tareas::class, 'categoria_id');
    }
}
