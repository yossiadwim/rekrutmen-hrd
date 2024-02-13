<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Laravel\Firebase\Facades\Firebase;


class FirebaseAuthController extends Controller
{
    
    protected $auth;

    public function __construct()
    {
        $this->auth = Firebase::auth();
    }

    public function createUserToFirebase(Request $request){

        $validation_data = $request->validate([
            'email' => 'email:dns|required|unique:users',
            'password' => 'required|min:5|max:255|'
        ]);

        $this->auth->createUserWithEmailAndPassword($validation_data['email_user_firebase'], $validation_data['password_user_firebase']);
    }
}
