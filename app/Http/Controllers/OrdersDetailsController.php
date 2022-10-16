<?php

namespace App\Http\Controllers;

use App\OrdersDetails;
use App\Products;
use Illuminate\Http\Request;

class OrdersDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $OrderDetails = OrdersDetails::all()->toArray();
        
        return $OrderDetails;
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
            "idproducto" => "required", 
            "idorder" => "required",        
             
        ]);
    
        $prod =   Products::find($request->idproducto);



        $orderDetail = new OrdersDetails();
        $orderDetail->idproducto = $request->idproducto;
        $orderDetail->idorder = $request->idorder;
        $orderDetail->cantidad = $request->cantidad;
        
        $orderDetail->codigo = $prod->codigo;
        $orderDetail->cantidad = $prod->cantidad;
        $orderDetail->precio = $prod->precio;

        $orderDetail->categoria = $prod->categoria;
        $orderDetail->modelo = $prod->modelo;
        $orderDetail->color = $prod->color;
        $orderDetail->descripcion = $prod->descripcion;
    
        if ($orderDetail->save()) {
            return response()->json([
                "status" => true,
                "task" => $orderDetail
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
     * @param  \App\OrdersDetails  $ordersDetails
     * @return \Illuminate\Http\Response
     */
    public function show(  Request $request)
    {
 

     //  $ordersDetails = new OrdersDetails();
     //  $sql = $ordersDetails->where('idorder',$request->idorder)->get();
  //   $sql =   OrdersDetails::where('idorder',"=",1)->get();
 $sql =   OrdersDetails::where('idorder' ,$request->idOrder)->get();
 //$sql =   OrdersDetails::all();
        return response()->json(           
               $sql 
         );
         

      //  return response()->json([$ordersdetails]);



    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OrdersDetails  $ordersDetails
     * @return \Illuminate\Http\Response
     */
    public function edit(OrdersDetails $ordersDetails)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OrdersDetails  $ordersDetails
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrdersDetails $ordersdetail)
    {
        
       
        $this->validate($request, [            
            "idproducto" => "required", 
            "idorder" => "required", 
        ]);
 
    
  

    
        if ( $ordersdetail->update([ 
          //  $request->all(),
             
          "idproducto" => $request->idproducto,
            "idorder" => $request->idorder, 
            "cantidad" => $request->cantidad>0?$request->cantidad:$ordersdetail->cantidad, 
            "precio" => $request->precio>0?$request->precio:$ordersdetail->precio, 
          ]
            
            )
        ) {
       
            
            return response()->json([
                "status" => true,
             //   "ordersdetail" => $ordersdetail,
              //  "request" =>$request->all()
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
     * @param  \App\OrdersDetails  $ordersDetails
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrdersDetails $ordersdetail)
    {
        if ($ordersdetail->delete()) {
            return response()->json([
                "status" => true,
                "Orders" => $ordersdetail
            ]);
        } else {
            return response()->json([
                "status" => false,
                "message" => "Ops, task could not be deleted."
            ]);
        }
    }



    


}
