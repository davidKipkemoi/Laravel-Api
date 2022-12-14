<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function Register(Request $request){
    $fields = $request -> validate([
        'name' => 'required|string',
        'email' => 'required|string|unique:users,email',
        'password'=> 'required|confirmed'

    ]);

      $user = User::create([
        'name' =>$fields['name'],
        'email'=>$fields['email'],
        'password'=> bcrypt ($fields['password'])


    ]);
        $token = $user -> createToken('myapptoken') ->plainTextToken;

        $response = [
            'user' =>$user,
            'token' =>$token
        ];

        return response($response, 201);


     }

}
