<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
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

                'service_id' => 'required',
                'user_id'=>'required',
                'review'=>'required',
                'hide'=>'required',
    
            ]);
    
            if($validator ->fails()){
                return response() -> json(['status' => 'fail','Validation_errors'=> $validator->error()]);
                
            }
    
            $data = $request->all();
            $data['user_id'] = auth()->id();
    
            $review = Review::create($data);
            if($review){
                return response()->json(['status'=>'success','message'=> 'Review stored successfully','data'=>$review]);
            }
            return response()-> json(['status'=>'fail','message'=> 'Review store failed']);

        }
        return response()-> json(['status'=>'fail','message'=> 'Unauthorised!'], 403);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        //
        $authUser = Auth::user();

        if($authUser){
            
            return response()-> json(['status'=>'success','message'=> 'Service found!', 'data'=>$review]);
        }
        return response()-> json(['status'=>'fail','message'=> 'Unauthorised!'], 403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        //
        $authUser = Auth::user();

        if($authUser){
            return response()-> json(['status'=>'success','message'=> 'Service found!', 'data'=>$review]);
        }
        return response()-> json(['status'=>'fail','message'=> 'Unauthorised!'], 403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Review $review)
    {
        //
        $authUser = Auth::user();

        if($authUser){
            $validator= Validator::make($request->all(), [
                'service_id' => 'required',
                'user_id'=>'required',
                'review'=>'required',
                'hide'=>'required',

    
            ]);
            if($validator ->fails()){
                return response() -> json(['status' => 'fail','Validation_errors'=> $validator->error()]);
            }
            $review->update($request->all());
            return response()-> json(['status'=>'success','message'=> 'Review updated!', 'data'=>$review]);
        }
        return response()-> json(['status'=>'fail','message'=> 'Unauthorised!'], 403);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        //
        $authUser = Auth::user();

        if($authUser){
            $review->delete();
            return response()-> json(['status'=>'success','message'=> 'Service deleted!', 'data'=>$review]);
        }
        return response()-> json(['status'=>'fail','message'=> 'Unauthorised!'], 403);
    }
}
