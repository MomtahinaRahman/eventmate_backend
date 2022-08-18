<?php

namespace App\Http\Controllers;

use App\Models\Subscribe;
use Illuminate\Http\Request;

class SubscribeController extends Controller
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
        if($authUser){
            $validator= Validator::make($request->all(), [

                'vendor_id' => 'required',
    
            ]);
    
            if($validator ->fails()){
                return response() -> json(['status' => 'fail','Validation_errors'=> $validator->error()]);
                
            }
    
            $data = $request->all();
            $data['user_id'] = auth()->id();
    
            $subscribe = Subscribe::create($data);
            if($subscribe){
                return response()->json(['status'=>'success','message'=> 'Subscription stored successfully','data'=>$subscribe]);
            }
            return response()-> json(['status'=>'fail','message'=> 'Subscription store failed']);

        }
        return response()-> json(['status'=>'fail','message'=> 'Unauthorised!'], 403);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subscribe  $subscribe
     * @return \Illuminate\Http\Response
     */
    public function show(Subscribe $subscribe)
    {
        //
        $authUser = Auth::user();

        if($authUser){
            
            return response()-> json(['status'=>'success','message'=> 'Subscription found!', 'data'=>$subscribe]);
        }
        return response()-> json(['status'=>'fail','message'=> 'Unauthorised!'], 403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subscribe  $subscribe
     * @return \Illuminate\Http\Response
     */
    public function edit(Subscribe $subscribe)
    {
        //
        $authUser = Auth::user();

        if($authUser){
            return response()-> json(['status'=>'success','message'=> 'Subscription found!', 'data'=>$subscribe]);
        }
        return response()-> json(['status'=>'fail','message'=> 'Unauthorised!'], 403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subscribe  $subscribe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subscribe $subscribe)
    {
        //
        $authUser = Auth::user();

        if($authUser){
            $validator= Validator::make($request->all(), [
                'vendor_id'=> 'required',
    
            ]);
            if($validator ->fails()){
                return response() -> json(['status' => 'fail','Validation_errors'=> $validator->error()]);
            }
            $subscribe->update($request->all());
            return response()-> json(['status'=>'success','message'=> 'Subscription updated!', 'data'=>$subscribe]);
        }
        return response()-> json(['status'=>'fail','message'=> 'Unauthorised!'], 403);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subscribe  $subscribe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subscribe $subscribe)
    {
        //
        $authUser = Auth::user();

        if($authUser){
            $subscribe->delete();
            return response()-> json(['status'=>'success','message'=> 'Subscription removed!', 'data'=>$subscribe]);
        }
        return response()-> json(['status'=>'fail','message'=> 'Unauthorised!'], 403);
    }
}
