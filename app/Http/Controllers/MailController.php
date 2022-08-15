<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SignUp;

class MailController extends Controller
{
    //
    public function sendMail(){
        $name='Momtahina Rahman Bushra';
        Mail::to('momtahina.rahman@northsouth.edu')->send(new SignUp($name));

        return view('welcome');
    }
}
