<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
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

                'user_id'=>'required',
                'date'=>'required',
                'time'=>'required',
                'location'=>'required',
                'budget'=>'required',
                'categories'=>'required',
                'cancel'=>'required',

    
            ]);
    
            if($validator ->fails()){
                return response() -> json(['status' => 'fail','Validation_errors'=> $validator->error()]);
                
            }
    
            $data = $request->all();
            $data['user_id'] = auth()->id();
    
            $event = Event::create($data);
            if($event){
                return response()->json(['status'=>'success','message'=> 'Event stored successfully','data'=>$event]);
            }
            return response()-> json(['status'=>'fail','message'=> 'Event store failed']);

        }
        return response()-> json(['status'=>'fail','message'=> 'Unauthorised!'], 403);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
        $authUser = Auth::user();

        if($authUser){
            
            return response()-> json(['status'=>'success','message'=> 'Service found!', 'data'=>$event]);
        }
        return response()-> json(['status'=>'fail','message'=> 'Unauthorised!'], 403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
        $authUser = Auth::user();

        if($authUser){
            return response()-> json(['status'=>'success','message'=> 'Service found!', 'data'=>$event]);
        }
        return response()-> json(['status'=>'fail','message'=> 'Unauthorised!'], 403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        //
        $authUser = Auth::user();

        if($authUser){
            $validator= Validator::make($request->all(), [
                'user_id'=>'required',
                'date'=>'required',
                'time'=>'required',
                'location'=>'required',
                'budget'=>'required',
                'categories'=>'required',
                'cancel'=>'required',
                
    
            ]);
            if($validator ->fails()){
                return response() -> json(['status' => 'fail','Validation_errors'=> $validator->error()]);
            }
            $event->update($request->all());
            return response()-> json(['status'=>'success','message'=> 'Review updated!', 'data'=>$event]);
        }
        return response()-> json(['status'=>'fail','message'=> 'Unauthorised!'], 403);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
        $authUser = Auth::user();

        if($authUser){
            $event->delete();
            return response()-> json(['status'=>'success','message'=> 'Event deleted!', 'data'=>$event]);
        }
        return response()-> json(['status'=>'fail','message'=> 'Unauthorised!'], 403);
    }
}
