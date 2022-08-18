<?php

namespace App\Http\Controllers;

use App\Models\Follow_vendor;
use Illuminate\Http\Request;

class Follow_vendorController extends Controller
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

                'vendor_id'=>'required',
    
            ]);
    
            if($validator ->fails()){
                return response() -> json(['status' => 'fail','Validation_errors'=> $validator->error()]);
                
            }
    
            $data = $request->all();
            $data['user_id'] = auth()->id();
    
            $follow_vendor = Follow_vendor::create($data);
            if($follow_vendor){
                return response()->json(['status'=>'success','message'=> 'Following vendor stored successfully','data'=>$follow_vendor]);
            }
            return response()-> json(['status'=>'fail','message'=> 'Following vendor store failed']);

        }
        return response()-> json(['status'=>'fail','message'=> 'Unauthorised!'], 403);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Follow_vendor  $follow_vendor
     * @return \Illuminate\Http\Response
     */
    public function show(Follow_vendor $follow_vendor)
    {
        //$authUser = Auth::user();

        if($authUser){
            
            return response()-> json(['status'=>'success','message'=> 'Following vendor found!', 'data'=>$follow_vendor]);
        }
        return response()-> json(['status'=>'fail','message'=> 'Unauthorised!'], 403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Follow_vendor  $follow_vendor
     * @return \Illuminate\Http\Response
     */
    public function edit(Follow_vendor $follow_vendor)
    {
        //
        $authUser = Auth::user();

        if($authUser){
            return response()-> json(['status'=>'success','message'=> 'Following vendor found!', 'data'=>$follow_vendor]);
        }
        return response()-> json(['status'=>'fail','message'=> 'Unauthorised!'], 403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Follow_vendor  $follow_vendor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Follow_vendor $follow_vendor)
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
            $follow_vendor->update($request->all());
            return response()-> json(['status'=>'success','message'=> 'Following vendor updated!', 'data'=>$follow_vendor]);
        }
        return response()-> json(['status'=>'fail','message'=> 'Unauthorised!'], 403);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Follow_vendor  $follow_vendor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Follow_vendor $follow_vendor)
    {
        //
        $authUser = Auth::user();

        if($authUser){
            $follow_vendor->delete();
            return response()-> json(['status'=>'success','message'=> 'Following vendor removed!', 'data'=>$follow_vendor]);
        }
        return response()-> json(['status'=>'fail','message'=> 'Unauthorised!'], 403);
    }
}
