<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
|
*/
    //loguea y registro usuarios
    Route::post("login", "AuthController@login");
    Route::post("register", "AuthController@register");//registrar usuario nuevo

    Route::group(["middleware" => "auth.jwt"], function () {

            //auth
            Route::get("logout", "AuthController@logout");

            //usuario
            Route::get("users", "AuthController@index");//listar usuarios
            Route::put("users/{user}", "AuthController@update");//datos un usuario
            Route::get("users/{user}", "AuthController@show");//actualizar un usuario
            Route::delete("users/{user}", "AuthController@destroy");//Elimina usuario
        
            //productos
            Route::resource("products", "ProductsController");

            //familias productos
            Route::resource("products", "ProductsController");

            //productos intermedios
            Route::resource("products", "ProductsController");
                
            // gestion de pedidos
            Route::resource("orders", "OrdersController");
            // gestion de pedidos detalle
            Route::resource("ordersdetails", "OrdersDetailsController");
            
            // dashboard
            Route::get("orders/area/{area}/estado/{estado}", "OrdersController@busqueda");//listar usuarios
            Route::get("orders/count/area/{area}/estado/{estado}", "OrdersController@count");//listar usuarios
            Route::get("dashboard", "OrdersController@dashboard");//dashboard

});
