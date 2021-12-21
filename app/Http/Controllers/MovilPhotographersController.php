<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Request\RegisterAuthRequest;
use JWTAuth;
use DB;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Picture;

class MovilPhotographersController extends Controller
{
    public function getPhotographers(){
        $user = JWTAuth::parseToken()->authenticate();
        $photographers = User::where('is_client', false)->get();
        foreach($photographers as $phot){
            $phot->image = url('/storage/images/'.$phot->image);
        } 

        return response()->json($photographers);
    }
}
