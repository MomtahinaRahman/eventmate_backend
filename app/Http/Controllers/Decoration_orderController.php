<?php

namespace App\Http\Controllers;

use App\Models\Decoration_order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class Decoration_orderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
        $authUser = Auth::user();

        if($authUser){
            $validator= Validator::make($request->all(), [

                'event_id'=>'required',
                'service_id'=>'required',
                
    
            ]);
    
            if($validator ->fails()){
                return response() -> json(['status' => 'fail','Validation_errors'=> $validator->error()]);
                
            }
    
            $data = $request->all();
            $data['user_id'] = auth()->id();
    
            $decoration_order = Decoration_order::create($data);
            if($decoration_order){
                return response()->json(['status'=>'success','message'=> 'Decoration Order stored successfully','data'=>$decoration_order]);
            }
            return response()-> json(['status'=>'fail','message'=> 'Decoration Order store failed']);

        }
        return response()-> json(['status'=>'fail','message'=> 'Unauthorised!'], 403);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Decoration_order  $decoration_order
     * @return \Illuminate\Http\Response
     */
    public function show(Decoration_order $decoration_order)
    {
        //
        $authUser = Auth::user();

        if($authUser){
            
            return response()-> json(['status'=>'success','message'=> 'Decoration Order found!', 'data'=>$decoration_order]);
        }
        return response()-> json(['status'=>'fail','message'=> 'Unauthorised!'], 403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Decoration_order  $decoration_order
     * @return \Illuminate\Http\Response
     */
    public function edit(Decoration_order $decoration_order)
    {
        //
        $authUser = Auth::user();

        if($authUser){
            return response()-> json(['status'=>'success','message'=> 'Decoration Order found!', 'data'=>$decoration_order]);
        }
        return response()-> json(['status'=>'fail','message'=> 'Unauthorised!'], 403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Decoration_order  $decoration_order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Decoration_order $decoration_order)
    {
        //
        $authUser = Auth::user();

        if($authUser){
            $validator= Validator::make($request->all(), [
                'event_id'=>'required',
                'service_id'=>'required',
    
            ]);
            if($validator ->fails()){
                return response() -> json(['status' => 'fail','Validation_errors'=> $validator->error()]);
            }
            $decoration_order->update($request->all());
            return response()-> json(['status'=>'success','message'=> 'Decoration Order updated!', 'data'=>$decoration_order]);
        }
        return response()-> json(['status'=>'fail','message'=> 'Unauthorised!'], 403);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Decoration_order  $decoration_order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Decoration_order $decoration_order)
    {
        //
        $authUser = Auth::user();

        if($authUser){
            $decoration_order->delete();
            return response()-> json(['status'=>'success','message'=> 'Decoration Order deleted!', 'data'=>$decoration_order]);
        }
        return response()-> json(['status'=>'fail','message'=> 'Unauthorised!'], 403);
    }
}
