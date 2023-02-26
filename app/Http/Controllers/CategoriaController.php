<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use App\Models\Categoria;


class CategoriaController extends Controller
{
    //
    

    public function index(){

        $categorias = Categoria::where('parent_id',NULL)->orderBy('id','desc')->get();

        return response()->json([
            'status' => 200,
            'categorias' => $categorias
        ]);
    }

    public function getSubCategorias($id){
        $subCategorias = Categoria::where('parent_id',$id)->get();

        return response()->json([
            'status' => 200,
            'subcategorias' => $subCategorias,
        ]);
    }
}
