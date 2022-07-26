<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
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
            $service= Service::where('user_id', $user->id)->get();
            if(count($service)>0){
                return response()->json(['status'=>'success','message'=> 'Service Found','data'=>$service]);
            }
            return response()-> json(['status'=>'fail','message'=> 'Service is not found']);
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
                'name' => 'required',
                'user_id'=> 'required',
                'vendor_id'=> 'required',
                'price'=>'required',
    
            ]);
    
            if($validator ->fails()){
                return response() -> json(['status' => 'fail','Validation_errors'=> $validator->error()]);
                
            }
    
            $data = $request->all();
            $data['user_id'] = auth()->id();
    
            $service = Service::create($data);
            if($service){
                return response()->json(['status'=>'success','message'=> 'Service stored successfully','data'=>$service]);
            }
            return response()-> json(['status'=>'fail','message'=> 'Service store failed']);

        }
        return response()-> json(['status'=>'fail','message'=> 'Unauthorised!'], 403);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
        $authUser = Auth::user();

        if($authUser){
            
            return response()-> json(['status'=>'success','message'=> 'Service found!', 'data'=>$service]);
        }
        return response()-> json(['status'=>'fail','message'=> 'Unauthorised!'], 403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        //
        $authUser = Auth::user();

        if($authUser){
            return response()-> json(['status'=>'success','message'=> 'Service found!', 'data'=>$service]);
        }
        return response()-> json(['status'=>'fail','message'=> 'Unauthorised!'], 403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        //
        $authUser = Auth::user();

        if($authUser){
            $validator= Validator::make($request->all(), [
                'name' => 'required',
                'user_id'=> 'required',
                'vendor_id'=> 'required',
                'price'=>'required',
    
            ]);
            if($validator ->fails()){
                return response() -> json(['status' => 'fail','Validation_errors'=> $validator->error()]);
            }
            $service->update($request->all());
            return response()-> json(['status'=>'success','message'=> 'Service updated!', 'data'=>$service]);
        }
        return response()-> json(['status'=>'fail','message'=> 'Unauthorised!'], 403);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        //
        $authUser = Auth::user();

        if($authUser){
            $service->delete();
            return response()-> json(['status'=>'success','message'=> 'Service deleted!', 'data'=>$service]);
        }
        return response()-> json(['status'=>'fail','message'=> 'Unauthorised!'], 403);
    }
}
