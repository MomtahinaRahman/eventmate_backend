<?php

namespace App\Http\Controllers;

use App\Models\Music_order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class Music_orderController extends Controller
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
                'music_service_id'=>'required',
                
    
            ]);
    
            if($validator ->fails()){
                return response() -> json(['status' => 'fail','Validation_errors'=> $validator->error()]);
                
            }
    
            $data = $request->all();
            $data['user_id'] = auth()->id();
    
            $music_order = Music_order::create($data);
            if($music_order){
                return response()->json(['status'=>'success','message'=> 'Music Order stored successfully','data'=>$music_order]);
            }
            return response()-> json(['status'=>'fail','message'=> 'Music Order store failed']);

        }
        return response()-> json(['status'=>'fail','message'=> 'Unauthorised!'], 403);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Music_order  $music_order
     * @return \Illuminate\Http\Response
     */
    public function show(Music_order $music_order)
    {
        //
        $authUser = Auth::user();

        if($authUser){
            
            return response()-> json(['status'=>'success','message'=> 'Music Order found!', 'data'=>$music_order]);
        }
        return response()-> json(['status'=>'fail','message'=> 'Unauthorised!'], 403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Music_order  $music_order
     * @return \Illuminate\Http\Response
     */
    public function edit(Music_order $music_order)
    {
        //
        $authUser = Auth::user();

        if($authUser){
            return response()-> json(['status'=>'success','message'=> 'Music Order found!', 'data'=>$music_order]);
        }
        return response()-> json(['status'=>'fail','message'=> 'Unauthorised!'], 403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Music_order  $music_order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Music_order $music_order)
    {
        //
        $authUser = Auth::user();

        if($authUser){
            $validator= Validator::make($request->all(), [
                'event_id'=> 'required',
                'music_service_id'=>'required',
    
            ]);
            if($validator ->fails()){
                return response() -> json(['status' => 'fail','Validation_errors'=> $validator->error()]);
            }
            $music_order->update($request->all());
            return response()-> json(['status'=>'success','message'=> 'Music Order updated!', 'data'=>$music_order]);
        }
        return response()-> json(['status'=>'fail','message'=> 'Unauthorised!'], 403);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Music_order  $music_order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Music_order $music_order)
    {
        //
        $authUser = Auth::user();

        if($authUser){
            $music_order->delete();
            return response()-> json(['status'=>'success','message'=> 'Music Order deleted!', 'data'=>$music_order]);
        }
        return response()-> json(['status'=>'fail','message'=> 'Unauthorised!'], 403);
    }
}
