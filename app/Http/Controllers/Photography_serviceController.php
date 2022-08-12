<?php

namespace App\Http\Controllers;

use App\Models\Photography_service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class Photography_serviceController extends Controller
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
            $photography_service= Photography_Service::where('user_id', $user->id)->get();
            if(count($photography_service)>0){
                return response()->json(['status'=>'success','message'=> 'Photography Service Found','data'=>$photography_service]);
            }
            return response()-> json(['status'=>'fail','message'=> 'Photography Service is not found']);
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
    
            $photography_service = Photography_Service::create($data);
            if($photography_service){
                return response()->json(['status'=>'success','message'=> 'Photography Service stored successfully','data'=>$photography_service]);
            }
            return response()-> json(['status'=>'fail','message'=> 'Photography Service store failed']);

        }
        return response()-> json(['status'=>'fail','message'=> 'Unauthorised!'], 403);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Photography_service  $photography_service
     * @return \Illuminate\Http\Response
     */
    public function show(Photography_service $photography_service)
    {
        //
        $authUser = Auth::user();

        if($authUser){
            
            return response()-> json(['status'=>'success','message'=> 'Photography Service found!', 'data'=>$photography_service]);
        }
        return response()-> json(['status'=>'fail','message'=> 'Unauthorised!'], 403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Photography_service  $photography_service
     * @return \Illuminate\Http\Response
     */
    public function edit(Photography_service $photography_service)
    {
        //
        $authUser = Auth::user();

        if($authUser){
            return response()-> json(['status'=>'success','message'=> 'Photography Service found!', 'data'=>$photography_service]);
        }
        return response()-> json(['status'=>'fail','message'=> 'Unauthorised!'], 403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Photography_service  $photography_service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Photography_service $photography_service)
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
            $photography_service->update($request->all());
            return response()-> json(['status'=>'success','message'=> 'Photography Service updated!', 'data'=>$photography_service]);
        }
        return response()-> json(['status'=>'fail','message'=> 'Unauthorised!'], 403);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Photography_service  $photography_service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Photography_service $photography_service)
    {
        //
        $authUser = Auth::user();

        if($authUser){
            $photography_service->delete();
            return response()-> json(['status'=>'success','message'=> 'Photography Service deleted!', 'data'=>$photography_service]);
        }
        return response()-> json(['status'=>'fail','message'=> 'Unauthorised!'], 403);
    }
}
