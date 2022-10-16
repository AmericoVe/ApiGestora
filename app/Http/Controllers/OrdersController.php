<?php

namespace App\Http\Controllers;

use App\Orders;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
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
        $orders = Orders::all()->sortByDesc("id")->toArray();
        
        return $orders;
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

        /*
        return response()->json([
            "status" => true,
            "user" => $request->user,
            "cliente" => $request->cliente,
            "direccion" => $request->direccion,
            "email" => $request->email,
            "fecha_solicitado" => $request->fecha_solicitado,
            "fecha_entrega" => $request->fecha_entrega,
            "estado" => $request->estado,
            "area" => $request->area,
        ]);
        /*
        return response()->json([
             "user" => $request->user,
            "cliente" => $request->cliente,
            "direccion" => $request->direccion,
            "email" => $request->email,
            "fecha_solicitado" => $request->fecha_solicitado,
            "fecha_entrega" => $request->fecha_entrega,
            "estado" => $request->estado,
            "area" => $request->area, 
        ]);*/

        
        $this->validate($request, [   
            "user" => "required", 
            "cliente" => "required",        
            "direccion" => "required",
            "email" => "required",
            "fecha_solicitado" => "required",
            "fecha_entrega" => "required",
            "estado" => "required",
            "area" => "required",
        ]);
    
        $order = new Orders();
        $order->user = $request->user;
        $order->cliente = $request->cliente;
        $order->direccion = $request->direccion;
        $order->email = $request->email;
        $order->fecha_solicitado = $request->fecha_solicitado;
        $order->fecha_entrega = $request->fecha_entrega;
        $order->estado = $request->estado;
        $order->area = $request->area;
    
        if ($order->save()) {
            return response()->json([
                  $order
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
     * @param  \App\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function show(Orders $order)
    {
        return response()->json([  $order
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function edit(Orders $orders)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Orders $order)
    {
        

         
       
       
        $this->validate($request, [            
            "user" => "required", 
            "cliente" => "required",        
            "direccion" => "required",
            "email" => "required",
            "fecha_solicitado" => "required",
            "fecha_entrega" => "required",
            "estado" => "required",
            "area" => "required",
        ]);

        
    /*
        $orders->user = $request->user;
        $orders->cliente = $request->cliente;
        $orders->direccion = $request->direccion;
        $orders->email = $request->email;
        $orders->fecha_solicitado = $request->fecha_solicitado;
        $orders->fecha_entrega = $request->fecha_entrega;
        $orders->estado = $request->estado;
        $orders->area = $request->area;
    

*/
    
  

    
        if ( $order->update([ 
          //  $request->all(),
             
            "user" => $request->user,
            "cliente" => $request->cliente,
            "direccion" => $request->direccion,
            "email" => $request->email,
            "fecha_solicitado" => $request->fecha_solicitado,
            "fecha_entrega" => $request->fecha_entrega,
            "estado" => $request->estado,
            "area" => $request->area, 
          ]
            
            )
        ) {
       
            
            return response()->json([
                "status" => true,
                "User" => $order
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
     * @param  \App\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function destroy(Orders $order)
    {


         
        if ($order->delete()) {
            return response()->json([
                "status" => true,
                "Orders" => $order
            ]);
        } else {
            return response()->json([
                "status" => false,
                "message" => "Ops, task could not be deleted."
            ]);
        }
    }

    
    /**
     * Display the specified resource.
     *
     * @param  \App\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function busqueda(  Request $request, $area,$estado)
    {
  
        /*
        return response()->json(        [   
             
 
                "request" => $request->all(),
                "area" =>  $area,
                "estado" => $estado
        ]
      );

      $wordCount = \DB::table('wordlist')->where('id', '<=', $correctedComparisons)
            ->count();
*/



//$users = User::whereRaw('age > ? and votes = 100', [25])->get();

$areax = ($area=="todos") ? "" : "area='$area' and ";
$estadox = ($estado=="todos") ? "" : "estado='$estado' and " ;

$estadoCond = ($estado=="cerrado") ? "" : " and estado <> 'cerrado'  " ;

$sql =  $areax.$estadox."1=1".$estadoCond;

 
 $rows =   Orders::whereRaw($sql)->orderBy("id", "desc")->get();
 
        return response()->json(           
               $rows 
         );
         

      //  return response()->json([$ordersdetails]);



    }

     /**
     * Display the specified resource.
     *
     * @param  \App\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function count(  Request $request, $area,$estado)
    {
  
        

            

 
$areax = ($area=="todos") ? "" : "area='$area' and ";
$estadox = ($estado=="todos") ? "" : "estado='$estado' and " ;

$estadoCond = ($estado=="cerrado") ? "" : " and estado <> 'cerrado'  " ;

$sql =  $areax.$estadox."1=1".$estadoCond;
 

/*
$rowsdd = \DB::table('orders')
            ->whereRaw($sql)
            ->where('estado', '<>','cerrado' )
            ->count();
*/

//$rows =   Orders::whereRaw($sql)->where('estado', '<>','cerrado' )->count();
  $rows =   Orders::whereRaw($sql)->count();

//  $rows = laravel_api::select("SELECT AREA, COUNT(*) FROM orders WHERE estado<>'?' GROUP BY area" ,["cerrado"]);

  //$//wordCount = \DB::table('wordlist')->where('id', '<=', $correctedComparisons)
        //    ->count();
 
 
        return response()->json(           
               $rows 
         );
         

      //  return response()->json([$ordersdetails]);



    }


     /**
     * Display the specified resource.
     *
     * @param  \App\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {  
      //  return response()->json("DASHBOARD");
        //areas
        $areax =  "area, COUNT(*) count ";
        $resArea =   DB::Table('orders')->selectRaw($areax)->where("estado", '<>','cerrado')->groupBy('area')->get();       
        //estados       
        $estadox = "estado, COUNT(*) count" ;
        $resEstado =   DB::Table('orders')->selectRaw($estadox)->groupBy('estado')->get();
        //areas por estado
        $areax_estadox = "area, estado,  COUNT(*) count";
        $resAreaEstado =   DB::Table('orders')->selectRaw($areax_estadox)->groupBy('area','estado')->get();
        //cantidad de items
      //  $items = "";
      //  $resItems =   Orders::whereRaw($areax)->get();
     
      return response()->json(["areax" => $resArea,"estadox" =>  $resEstado,"areax_estadox" => $resAreaEstado]);
    }

}
