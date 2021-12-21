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

class MovilPicturesController extends Controller
{
    public function getPictures(){
        $pictures = DB::table('pictures')
                            ->join('users' , 'pictures.user_id' ,'=', 'users.id')
                            ->select('pictures.id', 'pictures.image_name', 'pictures.address', 'pictures.created_at', 'pictures.amount',
                                        'users.name', 'users.phone')
                            ->get();
                            foreach($pictures as $pic){
                                $pic->address = url('/storage/pictures/'.$pic->address);
                            } 
        /*$pictures = Picture::get();
            foreach($pictures as $pic){
                $pic->address = url('/storage/pictures/'.$pic->address);
            }            */

        return response()->json($pictures);
    }
}
