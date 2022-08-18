<?php

namespace App\Http\Controllers;

use App\Models\Saved_post;
use Illuminate\Http\Request;

class Saved_postController extends Controller
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
    
            $saved_post = Saved_post::create($data);
            if($saved_post){
                return response()->json(['status'=>'success','message'=> 'Saved post stored successfully','data'=>$saved_post]);
            }
            return response()-> json(['status'=>'fail','message'=> 'Saved post store failed']);

        }
        return response()-> json(['status'=>'fail','message'=> 'Unauthorised!'], 403);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Saved_post  $saved_post
     * @return \Illuminate\Http\Response
     */
    public function show(Saved_post $saved_post)
    {
        //
        $authUser = Auth::user();

        if($authUser){
            
            return response()-> json(['status'=>'success','message'=> 'Saved Post found!', 'data'=>$saved_post]);
        }
        return response()-> json(['status'=>'fail','message'=> 'Unauthorised!'], 403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Saved_post  $saved_post
     * @return \Illuminate\Http\Response
     */
    public function edit(Saved_post $saved_post)
    {
        //
        $authUser = Auth::user();

        if($authUser){
            return response()-> json(['status'=>'success','message'=> 'Saved post found!', 'data'=>$saved_post]);
        }
        return response()-> json(['status'=>'fail','message'=> 'Unauthorised!'], 403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Saved_post  $saved_post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Saved_post $saved_post)
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
            $saved_post->update($request->all());
            return response()-> json(['status'=>'success','message'=> 'Saved post updated!', 'data'=>$saved_post]);
        }
        return response()-> json(['status'=>'fail','message'=> 'Unauthorised!'], 403);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Saved_post  $saved_post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Saved_post $saved_post)
    {
        //
        $authUser = Auth::user();

        if($authUser){
            $saved_post->delete();
            return response()-> json(['status'=>'success','message'=> 'Saved post removed!', 'data'=>$saved_post]);
        }
        return response()-> json(['status'=>'fail','message'=> 'Unauthorised!'], 403);
    }
}
