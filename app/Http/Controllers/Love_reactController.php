<?php

namespace App\Http\Controllers;

use App\Models\Love_react;
use Illuminate\Http\Request;

class Love_reactController extends Controller
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

                'post_id'=>'required',
    
            ]);
    
            if($validator ->fails()){
                return response() -> json(['status' => 'fail','Validation_errors'=> $validator->error()]);
                
            }
    
            $data = $request->all();
            $data['user_id'] = auth()->id();
    
            $love_react = Love_react::create($data);
            if($love_react){
                return response()->json(['status'=>'success','message'=> 'Love React stored successfully','data'=>$love_react]);
            }
            return response()-> json(['status'=>'fail','message'=> 'Love React store failed']);

        }
        return response()-> json(['status'=>'fail','message'=> 'Unauthorised!'], 403);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Love_react  $love_react
     * @return \Illuminate\Http\Response
     */
    public function show(Love_react $love_react)
    {
        //
        $authUser = Auth::user();

        if($authUser){
            
            return response()-> json(['status'=>'success','message'=> 'Love React found!', 'data'=>$love_react]);
        }
        return response()-> json(['status'=>'fail','message'=> 'Unauthorised!'], 403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Love_react  $love_react
     * @return \Illuminate\Http\Response
     */
    public function edit(Love_react $love_react)
    {
        //
        $authUser = Auth::user();

        if($authUser){
            return response()-> json(['status'=>'success','message'=> 'Love React found!', 'data'=>$love_react]);
        }
        return response()-> json(['status'=>'fail','message'=> 'Unauthorised!'], 403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Love_react  $love_react
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Love_react $love_react)
    {
        //
        $authUser = Auth::user();

        if($authUser){
            $validator= Validator::make($request->all(), [
                'post_id'=> 'required',
    
            ]);
            if($validator ->fails()){
                return response() -> json(['status' => 'fail','Validation_errors'=> $validator->error()]);
            }
            $love_react->update($request->all());
            return response()-> json(['status'=>'success','message'=> 'Love React updated!', 'data'=>$love_react]);
        }
        return response()-> json(['status'=>'fail','message'=> 'Unauthorised!'], 403);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Love_react  $love_react
     * @return \Illuminate\Http\Response
     */
    public function destroy(Love_react $love_react)
    {
        //
        $authUser = Auth::user();

        if($authUser){
            $love_react->delete();
            return response()-> json(['status'=>'success','message'=> 'Love React removed!', 'data'=>$love_react]);
        }
        return response()-> json(['status'=>'fail','message'=> 'Unauthorised!'], 403);
    }
}
