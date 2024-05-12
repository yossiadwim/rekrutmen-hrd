<?php

namespace App\Http\Controllers;

use Kreait\Laravel\Firebase\Facades\Firebase;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

use Illuminate\Http\Request;

class ControllerAuthSSO extends Controller
{
    protected $firebaseAuth;

    public function __construct()
    {
        $this->firebaseAuth = Firebase::auth();
    }


    public function sso_auth(Request $request)
    {
        $token = $request->input('firebaseToken');
        error_log($token);
        if ($token) {
            try {
                $signInResult = $this->firebaseAuth->signInWithCustomToken($token);
                if ($signInResult) {

                    $user = $signInResult->data();

                    $idToken = $user['idToken'];

                    $verifiedIdToken = $this->firebaseAuth->verifyIdToken($idToken);

                    $uid = $verifiedIdToken->claims()->get('sub');

                    // Get the user object from Firebase
                    $userId = $this->firebaseAuth->getUser($uid);

                    $user = User::where('email', $userId->email)
                        ->get();

                    error_log(json_encode($user[0]));

                    if($user){
                        Auth::loginUsingId($user[0]->id);;
                        if ($user[0]->role === 'admin') {
                            $request->session()->regenerate();
                            // return response()->json(['success' => $user[0]]);
                            return redirect('/admin-dashboard/lowongan');
                        } else {
                            $request->session()->regenerate();
                            // return response()->json(['success' => $user[0]]);
                            return redirect('/lowongan-kerja');
                        }
                    }
                    
                } else {
                    return response()->json(['error' => 'Failed to sign in with custom token'], 500);
                }
            } catch (\Exception $e) {
                return response()->json(['error' => $e->getMessage()], 500);
            }
        } else {
            return response()->json(['error' => 'Firebase token not provided'], 400);
        }
    }
}
