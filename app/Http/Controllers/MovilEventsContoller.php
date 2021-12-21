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
use App\Models\Evento;

class MovilEventsContoller extends Controller
{
    public function getMyEvents(){
        $user = JWTAuth::parseToken()->authenticate();
        $events = Evento::where('host_id', $user->id)->get();

        return response()->json($events);
    }

    public function getMyFreeEvents(){
        $user = JWTAuth::parseToken()->authenticate();
        $events = Evento::where('host_id', $user->id)
                        ->whereNull('photographer_id')
                        ->get();

        return response()->json($events);
    }

    public function saveEvent(Request $request){
        $user = JWTAuth::parseToken()->authenticate();

        try {
            $req = new Evento();
            $req->name = $request->name;
            $req->date = $request->date;
            $req->time = $request->time;
            $req->location = $request->location;
            $req->host_id = $user->id;
            $req->host_name = $user->name;
            $req->save();

            //Mandar Notificacion 
            /*$recipients = worker::findOrFail($request->id)->pluck('fcm_token')->all();

            $SERVER_API_KEY = 'AAAAASvPp2s:APA91bEAWvpTqQSuzLr75D7CIu77JsnvymeV-t_4f6gRM-pdvAEvw-7RSMAXWhzxGQtj1xB9f-uks6NY-pitSqiHvLqUlINmBB-XYlWJHIv4y8p_7zewhLAw_MmmnbMmxM78cWtRQ-Vq';
    
            $data = [
                "registration_ids" => $recipients,
                "notification" => [
                    "title" => "Solicitud de Trabajo",
                    "body" => "Tienes una nueva solicitud, conoce los detalles en la app",  
                ]
            ];
            $dataString = json_encode($data);
        
            $headers = [
                'Authorization: key=' . $SERVER_API_KEY,
                'Content-Type: application/json',
            ];
        
            $ch = curl_init();
        
            curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
                
            //$response = 
            curl_exec($ch);//dd($response);*/

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

    public function saveEventPhot(Request $request){
        $user = JWTAuth::parseToken()->authenticate();

        try {
            //dd($request->phot);
            $photo = User::findOrFail($request->phot);
            $req = Evento::findOrFail($request->event);
            $req->photographer_id = $photo->id;
            $req->photographer_name = $photo->name;
            $req->save();

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
