<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\OrderPlaced;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //

    public function register(Request $request)
    {
        $validator= Validator::make($request->all(), [
            'name' => 'required',
            'email'=> 'required|email|unique:users',
            'password'=> 'required|min:1',


        ]);

        if($validator ->fails()){
            return response() -> json(['status' => 'fail','validation_errors'=> $validator->errors()]);

        }

        $data = $request->all();
        $data['password'] = Hash::make($request->password);

        $user = User::create($data) ;

        if($user){
            return response()-> json(['status'=>'success','message'=> 'User registration successfully completed','data'=>$user]);
        }
        return response()-> json(['status'=>'fail','message'=> 'User registration failed']);
    }

    public function login(Request $request)
    {
        $validator= Validator::make($request->all(), [
            'email'=> 'required|email',
            'password'=> 'required|min:1'

        ]);

        if($validator ->fails()){
            return response()-> json(['status' => 'fail','validation_errors'=> $validator->error()]);
        }
        //login
        if(Auth::attempt(['email'=> $request->email, 'password' => $request->password])){
            $user = Auth::user();
            $token = $user-> createToken('usertoken')->accessToken;
            
            return response()->json(['status'=>'success','login'=> true, 'token'=> $token,'data'=> $user]);
        }
        else{
            return response()->json(['status'=>'fail', 'message'=> 'Whoops! The email or password is invalid']);
        }
    }

    public function userDetail()
    {
        $user = Auth::user();
        if($user){
            return response()->json(['status'=>'success','user'=> $user]);
        }
        return response()->json(['status'=>'fail','message'=>'User not found']);
    }

    public function logout(Request $request)
    {
        $response = array();
        if (Auth::check()) {
            
            Auth::user()->token()->revoke();
            $response['error'] = 0;
            $response['message'] = "Successfully logged out.";
            return response()->json($response);
        }
        else{
            $response['error'] = 1;
            $response['message'] = "You are not logged in.";
            return response()->json($response);
        }

    }

    public function noti()
    {
      // if (Auth::check()) {
      //       $user = Auth::user();
      //     return response()->json($user);
            
      //   }
      //   else{
      //       $response['error'] = 1;
      //       $response['message'] = "You are not logged in.";
      //       return response()->json($response);
      // }
        
        $user = User::findOrFail(2);
        $user-> notify(new OrderPlaced($user));
        // dd("done");
        // return response()->json($user);

        // notify(new OrderPlaced($user));
        // event(new MyEvent('hello world'));
    }

    
    // notification
    // protected function create(array $data)
    // {
    //     $user=User::create([
    //         'name' => $data['name'],
    //         'email' => $data['email'],
    //         'password' => bcrypt($data['password']),

    //     ]);
        
    //     /*foreach (Admin::all() as $admin){
    //         $admin-> notify(new RepliedToThread($user));
    //     }*/

    //     return $user;
    // }

    //function login(Request $request)
    //{
        
     //   $user= User::where('email', $request->email)->first();
        // print_r($data);
       //     if (!$user || !Hash::check($request->password, $user->password)) {
         //       return response([
         //           'message' => ['These credentials do not match our records.']
         //       ], 404);
         //   }

          //  Auth::login($user);
        
           // $token = $user->createToken('my-app-token')->plainTextToken;
        
           // $response = [
           //     'user' => $user,
           //     'token' => $token
           // ];
        
           //  return response($response, 201);
    //}
}
