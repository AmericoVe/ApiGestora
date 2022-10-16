<?php

namespace App\Http\Controllers;

use App\Products;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
 

class ProductsController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Products::all()->toArray();
        
        return $products;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [            
             
            "codigo" => "required",        
            "descripcion" => "required",
            "categoria" => "required",
            "modelo" => "required",
            "color" => "required",
            
        ]);
    
        $products = new Products();
        
        $products->codigo = $request->codigo;
        $products->descripcion = $request->descripcion;
        $products->categoria = $request->categoria;
        $products->modelo = $request->modelo;
        $products->color = $request->color;
        
    
        if ($products->save()) {
            return response()->json([
                "status" => true,
                "task" => $products
            ]);
        } else {
            return response()->json([
                "status" => false,
                "message" => "Ops, task could not be saved."
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(Products $product)
    {
 
        return response()->json([  $product
        ]);

  
/*
        if ( User::find($product)) {
            return User::find($product)->toArray();
             
            
        } else {
            return response()->json([
                "status" => false,
                "message" => "Ops, task could not be deleted."
            ]);
        }
*/
         
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(Products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Products $product)
    {
          /*
         
        $this->validate($request, [            
            "codigo" => "required",        
            "descripcion" => "required",
            "categoria" => "required",
            "modelo" => "required",
            "color" => "required",
        ]);

      
    
        $product->codigo = $request->codigo;
        $product->descripcion = $request->descripcion;
        $product->categoria = $request->categoria;
        $product->modelo = $request->modelo;
        $product->color = $request->color;
    
         if ($product->save()) {
            return response()->json([
                "status" => true,
                "task" => $product
            ]);
        } else {
            return response()->json([
                "status" => false,
                "message" => "Ops, task could not be updated."
            ], 500);
        }

        */
/*
        $this->validate($request, [            
            "id" => "required"
        ]);*/

        $product->codigo = $request->codigo?$request->codigo:$product->codigo;
        $product->descripcion = $request->descripcion?$request->descripcion:$product->descripcion;
        $product->categoria = $request->categoria?$request->categoria:$product->categoria;
        $product->modelo = $request->modelo?$request->modelo:$product->modelo;
        $product->color = $request->color?$request->color:$product->color;

        if ($product->save()) {
            return response()->json([
                "status" => true,
                "task" => $product
            ]);
        } else {
            return response()->json([
                "status" => false,
                "message" => "Ops, task could not be updated."
            ], 500);
        }

       

         
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Products $product)
    {
         
        if ($product->delete()) {
            return response()->json([
                "status" => true,
                "products" => $product
            ]);
        } else {
            return response()->json([
                "status" => false,
                "message" => "Ops, task could not be deleted."
            ]);
        }
 


    }
}
