<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Request\RegisterAuthRequest;
use JWTAuth;
use DB;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Card;

class MovilUsersController extends Controller
{
    public $loginAfterSignUp = true;
    
    public static $AUTH_S = 'CUENTA';

    //Registro
    public function register(Request $request){
        if($request->image){
            $image = $request->image;  // your base64 encoded
            $image = str_replace('data:image.png;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $filename = time().'.png';
            Storage::disk('images')->put($filename, base64_decode($image));     
        }else{
            $filename = 'noimage.jpg';
        }

        $user = new User();
        $user->name = $request->name;
        $user->phone = $request->number;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->image = $filename;
        $user->is_client = true;
        $user->save();

        if($this->loginAfterSignUp ){
            return $this->login($request);
        }

        response()->json([
            'status' => 'ok',
            'data' => $user
        ], 200);
    }

    //Login
    public function login(Request $request){
        $input = $request->only('email', 'password');
        $jwt_token = null;

        if(!$jwt_token = JWTAuth::attempt($input)){
            return response()->json([
                'status' => 'invalid_credentials',
                'message' => 'Correo o contraseña no válidos.',
            ], 401);
        }

        if (User::where('email', $request->email)->where('is_client', true)->exists()) {
            $user = User::where('email', $request->email)->where('is_client', true)->first();
            $user->fcm_token = $request->token;
            $user->save();
            return response()->json([
                'status' => 'ok',
                'token' => $jwt_token,
            ]);
        }
    }

    //Logout
    public function logout(Request $request){
        $this->validate($request, [
            'token' => 'required',
        ]);

        //auth()->logout();
        try{
            JWTAuth::invalidate($request->token);
            return response()->json([
                'status' => 'ok',
                'message' => 'Cierre de sesion exitoso.'
            ]);
        } catch(JWTException $exception){
            return response()->json([
                'status' => 'unknow_error',
                'message' => 'Error al cerrar sesion.'
            ], 500);
        }
    }

    public function getAuthUser(Request $request){
        $this->validate($request, [
            'token' => 'required',
        ]);

        $user = JWTAuth::authenticate($request->token);
        return response()->json(['user' => $user]);
    }

    public function getAuthenticatedUser(){
        try {
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['token_absent'], $e->getStatusCode());
        }
        //$getUser = worker::where('user_id', $user->id)->select('name', 'cover_image')->first();
        /*$getUser = DB::table('workers')
                            ->where('user_id', $user->id)
                            ->join('users' , 'workers.user_id' ,'=', 'users.id')
                            ->select('users.email', 'workers.name', 'workers.cover_image')
                            ->first();
        $getUser->cover_image = url('/storage/cover_image/'.$getUser->cover_image);*/
        //$getUser = User::findOrFail($user->id);
        $getUser = DB::table('users')
                            ->where('id', $user->id)
                            ->select('users.id','users.email', 'users.phone', 'users.name', 'users.image')
                            ->first();
        $getUser->image = url('/storage/images/'.$getUser->image);
        
        return response()->json(compact('getUser'));
    }

    public function saveCard(Request $request){
        $user = JWTAuth::parseToken()->authenticate();

        try {
            //dd($request->phot);
            if (Card::where('user_id', $user->id)->exists()) {
                $card1 = Card::where('user_id', $user->id)->first();
                $card1->number = $request->number;
                $card1->expiration_date = $request->date;
                $card1->cvc = $request->cvc;
                $card1->save();
            } else {
                $card2 = new Card();
                $card2->user_id = $request->id;
                $card2->number = $request->number;
                $card2->expiration_date = $request->date;
                $card2->cvc = $request->cvc;
                $card2->save();
            }

            return response()->json([
                "ok" => true,
                "message" => "Se registro con exito!!",
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                "ok" => false,
                "error" => $ex->getMessage(),
            ]);
        }
    }
}
