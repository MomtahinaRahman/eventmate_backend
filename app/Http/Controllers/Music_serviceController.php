<?php

namespace App\Http\Controllers;

use App\Models\Music_service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class Music_serviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = Auth::user();
        if($user){
            $music_service= Music_Service::where('user_id', $user->id)->get();
            if(count($music_service)>0){
                return response()->json(['status'=>'success','message'=> 'Music Service Found','data'=>$music_service]);
            }
            return response()-> json(['status'=>'fail','message'=> 'Music Service is not found']);
        }
        return response()-> json(['status'=>'fail','message'=> 'Unauthorised!'], 403);
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
                'vendor_id'=> 'required',
                'price'=>'required',
    
            ]);
    
            if($validator ->fails()){
                return response() -> json(['status' => 'fail','Validation_errors'=> $validator->error()]);
                
            }
    
            $data = $request->all();
            $data['user_id'] = auth()->id();
    
            $music_service = Music_Service::create($data);
            if($music_service){
                return response()->json(['status'=>'success','message'=> 'Music Service stored successfully','data'=>$music_service]);
            }
            return response()-> json(['status'=>'fail','message'=> 'Music Service store failed']);

        }
        return response()-> json(['status'=>'fail','message'=> 'Unauthorised!'], 403);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Music_service  $music_service
     * @return \Illuminate\Http\Response
     */
    public function show(Music_service $music_service)
    {
        //
        $authUser = Auth::user();

        if($authUser){
            
            return response()-> json(['status'=>'success','message'=> 'Music Service found!', 'data'=>$music_service]);
        }
        return response()-> json(['status'=>'fail','message'=> 'Unauthorised!'], 403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Music_service  $music_service
     * @return \Illuminate\Http\Response
     */
    public function edit(Music_service $music_service)
    {
        //
        $authUser = Auth::user();

        if($authUser){
            return response()-> json(['status'=>'success','message'=> 'Music Service found!', 'data'=>$music_service]);
        }
        return response()-> json(['status'=>'fail','message'=> 'Unauthorised!'], 403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Music_service  $music_service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Music_service $music_service)
    {
        //
        $authUser = Auth::user();

        if($authUser){
            $validator= Validator::make($request->all(), [
                'vendor_id'=> 'required',
                'price'=>'required',
    
            ]);
            if($validator ->fails()){
                return response() -> json(['status' => 'fail','Validation_errors'=> $validator->error()]);
            }
            $music_service->update($request->all());
            return response()-> json(['status'=>'success','message'=> 'Music Service updated!', 'data'=>$music_service]);
        }
        return response()-> json(['status'=>'fail','message'=> 'Unauthorised!'], 403);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Music_service  $music_service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Music_service $music_service)
    {
        //
        $authUser = Auth::user();

        if($authUser){
            $music_service->delete();
            return response()-> json(['status'=>'success','message'=> 'Music Service deleted!', 'data'=>$music_service]);
        }
        return response()-> json(['status'=>'fail','message'=> 'Unauthorised!'], 403);
    }
}
