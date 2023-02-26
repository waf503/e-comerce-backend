<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;
    protected $table = 'categorias';

    protected $with = ['parent'];
    public function parent(){
        return $this->belongsTo(Categoria::class, 'parent_id', 'id');
    }

    public function productos(){
        return $this->hasMany('App\Models\Producto');
    }
}
