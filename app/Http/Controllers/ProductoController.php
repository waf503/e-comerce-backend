<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\Producto;
use Illuminate\Support\Facades\Validator;


class ProductoController extends Controller
{
    //

    public function index() {
        $list_product = Producto::orderBy('id','asc')->get();
        return response()->json([
            'status' => 200,
            'productos' => $list_product
            
        ]);
    }

    public function store(Request $request) {

        $validate = Validator::make($request->all(), [
            'name'=>'required',
            
            'description' => 'required',
            'price' => 'required',
            'category_id' => 'required'
        ]);
        
        if($validate->fails()){
            return response()->json([
                'status'=>422,
                'errors'=>$validate->messages(),
            ]);
        }
        else{
            $product = new Producto;
            //recogiendo la imagen
            $image_path = $request->file('image_path');

            //subir fichero
            if($image_path){
                $image_path_name = time().$image_path->getClienteOriginalName();
                Storage::disk('images')->put($image_path_name, File::get($image_path));

                $product->image_path = $image_path_name;
            }
            if($request->input('subCategoria_id')){
                $product->category_id = $request->input('subCategoria_id');
            }
            else{
                $product->category_id = $request->input('category_id');
            }            
            $product->name = $request->input('name');
            $product->description = $request->input('description');
            $product->price = $request->input('price');

            // if($request->hasFile('image_path')){
            //     $file = $request->file('image_path');
            //     $extension = $file->getClientOriginalExtension();
            //     $filename = time().'.'.$extension;
            //     $file->move('uploads/product/', $filename);
            //     $product->image_path = 'uploads/product/'.$filename;
            // }

            $product->save();
            return response()->json([
                'status'=>200,
                'message'=>'Producto agregado de forma correcta',
            ]);
        }

        
    }

    public function edit($id) {
        $product = Producto::find($id);
        if($product){
            return response()->json([
                'status' =>200,
                'product' =>$product,
            ]);
        }
        else 
        {
            return response()->json([
                'status'=>404,
                'message'=>'No Product Found',
            ]);
        }
    }

    public function update(Request $request, $id) {
        $validate = Validator::make($request->all(), [
            'name'=>'required',
            'description' => 'required',
            'price' => 'required',
            'category_id' => 'required'
        ]);
        
        if($validate->fails()){
            return response()->json([
                'status'=>422,
                'errors'=>$validate->messages(),
            ]);
        }
        else{
            $product = Producto::find($id);
            if($product){
                if($request->input('subCategoria_id')){
                    $product->category_id = $request->input('subCategoria_id');
                }
                else{
                    $product->category_id = $request->input('category_id');
                }            
                $product->name = $request->input('name');
                $product->description = $request->input('description');
                $product->price = $request->input('price');
    
                
    
                $product->update();
                return response()->json([
                    'status'=>200,
                    'message'=>'Producto actualizado de forma correcta',
                ]);
            }
            else{
                return response()->json([
                    'status'=>404,
                    'message'=>'Producto no actualizado!',
                ]);
            }
            
        }
    }

    public function delete($id) {
        $producto = Producto::find($id);

        if($producto){
            $producto->delete();
            return response()->json([
                'status'=>200,
                'message'=>'Se elimino correctamente',
            ]);
        }
        else{
            return response()->json([
                'status'=>404,
                'message'=>'No Product Found',
            ]);
        }
    }
    
}
