<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Search;
use App\Models\Image;


class SearchController extends Controller
{

    public function index()
    {
        $response = array();

        if (Auth::check()) {
            $searches=Auth::user()->searches;
    
            $activeSearches= $searches->where('active',1);
            $preSearches= $searches->where('active',0);

            $response['error'] = 0;
            $response['message'] = 'All of your searches.';
            $response['activeSearches'] = $activeSearches;
            $response['preSearches'] = $preSearches;       
            $response['token'] = Auth::user()->createToken('kiLagbe')->accessToken;
        }
        else{
            $response['error'] = 1001;
            $response['message'] = "You are not logged in.";
        }

        return response()->json($response);
    }

    
    public function createImages(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:4|max:255',
            'images' => 'required',
            'images.*' => 'mimes:jpeg,jpg,png,gif,csv,txt,pdf|max:2048'
        ]);

        $response = array();

        if ($validator->fails()) {
            $response['error'] = 1;
            $response['message'] = $validator->errors();
            return response()->json($response);
        } 

        if (Auth::check()) {

            $i=0;
            if($request->hasfile('images')) {
                foreach($request->file('images') as $file)
                {
                    $i= $i+1;
                    $extension = $file->getClientOriginalExtension();
                    $name = str_replace(" ","_",$request->input('name')). '###'. $i. '.'. $extension;
                    // $path = $file->move(public_path().'/uploads/', $name);
                    $path = $file->storePublicly('images');
                    $url = Storage::url($path);

                    $response['image'.'name'.$i] =$name;
                    $response['image'.'url'.$i] =$url;
                }
            }
            else{
                $response['error'] = 1;
                $response['message'] = "No valid Image.";
            }

            $response['error'] = 0;
            $response['message'] = 'Your images have been uploaded.';         
            $response['token'] = Auth::user()->createToken('kiLagbe')->accessToken;
        }
        else{
            $response['error'] = 1001;
            $response['message'] = "You are not logged in.";
        }

        return response()->json($response);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:4|max:255',
            'description' => 'max:255',
            'category_id' => 'required| integer',
            'condition' => 'required|digits:1',
            'image_names' => 'required|array',
            'image_names.*' => 'required|string|max:255',
            'image_urls' => 'required|array',
            'image_urls.*' => 'required|string|max:255'
        ]);

        $response = array();

        if ($validator->fails()) {
            $response['error'] = 1;
            $response['message'] = $validator->errors();
            return response()->json($response);
        } 

        if (Auth::check()) {
            $search=new Search;
            $search->buyer_id= Auth::id();
            $search->name= $request->input('name');
            $search->description= $request->input('description');
            $search->category_id= $request->input('category_id');
            $search->condition= $request->input('condition');
            $search->save();


            $imageNamesArr = array();
            $imageUrlsArr = array();

            $i=0;
            foreach($request->input('image_names') as $name)
            {
                $imageNamesArr[$i] = $name;
                $i= $i+1;
            }
            
            $i=0;
            foreach($request->input('image_urls') as $url)
            {
                $imageUrlsArr[$i] = $url;
                $i= $i+1;
            }

            $i=0;
            foreach($request->input('image_urls') as $image)
            {
                //store image file into directory and db
                $image = new Image();
                $image->type = 1;
                $image->foreign_id = $search->id;
                $image->name = $imageNamesArr[$i];
                $image->image_path = $imageUrlsArr[$i];
                $image->save();

                $i= $i+1;
            }


            $response['error'] = 0;
            $response['message'] = 'Your Search has been created.';         
            $response['token'] = Auth::user()->createToken('kiLagbe')->accessToken;
        }
        else{
            $response['error'] = 1001;
            $response['message'] = "You are not logged in.";
        }

        return response()->json($response);
    }

    public function show(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'search_id' => 'required|integer'
        ]);

        $response = array();

        if ($validator->fails()) {
            $response['error'] = 1;
            $response['message'] = $validator->errors();
            return response()->json($response);
        } 

        if (Auth::check()) {
            $search=Search::find($request->search_id);
            if($search){
                $bids= $search->bids;
                $images= $search->images;
                $response['error'] = 0;
                $response['message'] = 'Details of a particular search.';
                $response['search'] = $search->makeHidden('bids','images');
                $response['images'] = $images;                 
                $response['bids'] = $bids;
                $response['token'] = Auth::user()->createToken('kiLagbe')->accessToken;
            }
            else{
                $response['error'] = 3001;
                $response['message'] = 'Search id not found.';     
            }
        }
        else{
            $response['error'] = 1001;
            $response['message'] = "You are not logged in.";
        }

        return response()->json($response);
    }

    public function edit(Request $request)
    {
        //
    }
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:4|max:255',
            'description' => 'max:255',
            'category_id' => 'required|integer',
            'condition' => 'required|digits:1',
            'active' => 'required|integer',
            'search_id' => 'required|integer'
        ]);

        $response = array();

        if ($validator->fails()) {
            $response['error'] = 1;
            $response['message'] = $validator->errors();
            return response()->json($response);
        } 

        if (Auth::check()) {
            $search=Search::find($request->input('search_id'));
            if($search){
                $search->name= $request->input('name');
                $search->description= $request->input('description');
                $search->category_id= $request->input('category_id');
                $search->condition= $request->input('condition');
                $search->active= $request->input('active');
                $search->save();
    
                $response['error'] = 0;
                $response['message'] = 'Your Search have been edited.';
                $response['userId'] = Auth::id();             
                $response['token'] = Auth::user()->createToken('kiLagbe')->accessToken;
            }
            else{
                $response['error'] = 3001;
                $response['message'] = 'Search id not found.';     
            }
        }
        else{
            $response['error'] = 1;
            $response['message'] = "You are not logged in.";
        }

        return response()->json($response);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
