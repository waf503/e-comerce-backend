<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categoria;

class Producto extends Model
{
    use HasFactory;
    protected $table = 'productos';
    protected $fillable = [
       'category_id',
       'name',
       'description',
       'price',
       'image_path'
    ];

    protected $with = ['categoria'];
    public function categoria(){
        return $this->belongsTo(Categoria::class, 'category_id', 'id');
    }
}
