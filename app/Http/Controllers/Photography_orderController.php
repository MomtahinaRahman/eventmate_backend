<?php

namespace App\Http\Controllers;

use App\Models\Photography_order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class Photography_orderController extends Controller
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
                'photography_service_id'=>'required',
                
    
            ]);
    
            if($validator ->fails()){
                return response() -> json(['status' => 'fail','Validation_errors'=> $validator->error()]);
                
            }
    
            $data = $request->all();
            $data['user_id'] = auth()->id();
    
            $photography_order = Photography_order::create($data);
            if($photography_order){
                return response()->json(['status'=>'success','message'=> 'Photography Order stored successfully','data'=>$photography_order]);
            }
            return response()-> json(['status'=>'fail','message'=> 'Photography Order store failed']);

        }
        return response()-> json(['status'=>'fail','message'=> 'Unauthorised!'], 403);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Photography_order  $photography_order
     * @return \Illuminate\Http\Response
     */
    public function show(Photography_order $photography_order)
    {
        //
        $authUser = Auth::user();

        if($authUser){
            
            return response()-> json(['status'=>'success','message'=> 'Photography Order found!', 'data'=>$photography_order]);
        }
        return response()-> json(['status'=>'fail','message'=> 'Unauthorised!'], 403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Photography_order  $photography_order
     * @return \Illuminate\Http\Response
     */
    public function edit(Photography_order $photography_order)
    {
        //
        $authUser = Auth::user();

        if($authUser){
            return response()-> json(['status'=>'success','message'=> 'Photography Order found!', 'data'=>$photography_order]);
        }
        return response()-> json(['status'=>'fail','message'=> 'Unauthorised!'], 403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Photography_order  $photography_order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Photography_order $photography_order)
    {
        //
        $authUser = Auth::user();

        if($authUser){
            $validator= Validator::make($request->all(), [
                'event_id'=> 'required',
                'photography_service_id'=>'required',
    
            ]);
            if($validator ->fails()){
                return response() -> json(['status' => 'fail','Validation_errors'=> $validator->error()]);
            }
            $photography_order->update($request->all());
            return response()-> json(['status'=>'success','message'=> 'Photography Order updated!', 'data'=>$photography_order]);
        }
        return response()-> json(['status'=>'fail','message'=> 'Unauthorised!'], 403);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Photography_order  $photography_order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Photography_order $photography_order)
    {
        //
        $authUser = Auth::user();

        if($authUser){
            $photography_order->delete();
            return response()-> json(['status'=>'success','message'=> 'Photography Order deleted!', 'data'=>$photography_order]);
        }
        return response()-> json(['status'=>'fail','message'=> 'Unauthorised!'], 403);
    }
}
