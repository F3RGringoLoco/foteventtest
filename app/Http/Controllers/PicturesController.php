<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Picture;
use App\Models\Evento;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PicturesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pictures = Picture::where('user_id', Auth::id())->get();
        $eventos = Evento::get();
        return view('picture.index', compact('pictures', 'eventos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'image' => 'required',
            'image.*' => 'image|max:1999'
        ]);

        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $ima) {
                $fileNameWithExt = $ima->getClientOriginalName();
                //Get just filename
                $filename = pathinfo($fileNameWithExt ,PATHINFO_FILENAME);
                //Get just ext
                $extension = $ima->getClientOriginalExtension();
                //Filename to store
                $fileNameToStore = $filename.'_'.time().'.'.$extension;
                //Upload image
                $path = $ima->storeAs('public/pictures', $fileNameToStore);

                $picture = new Picture();
                $picture->image_name = $filename;
                $picture->address = $fileNameToStore;
                $picture->user_id = Auth::id();
                if(!is_null($request->input('event'))){
                    $picture->event_id = $request->input('event');
                }
                $picture->save();
            }
        }

        //Mandar Notificaciones 
            $recipients = User::pluck('fcm_token')->all();

            $SERVER_API_KEY = 'AAAAvSnDNc4:APA91bF74Kd8I4fHS_ETesmLdUMM9jTmJHkRIETb7QuapobRBWxEmjLZRbrwzAeeZkiKBB0RQf0MPpHhIdUGR8FOLZ2ghHAA649ADiRMct-N6fRhK1Fi-d5KwwV-52WcBdzG4HNv35TJ';
    
            $data = [
                "registration_ids" => $recipients,
                "notification" => [
                    "title" => "Nuevas Fotografias Publicadas",
                    "body" => "Hay nuevas fotografias!, ven y elige la que mas te gusta",  
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
            curl_exec($ch);//dd($response);

        return redirect()->route('picture.index')->with('success', 'Fotografías Guardados');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $picture = Picture::findOrFail($id);
        $event = null;
        if (!is_null($picture->event_id)) {
            $event = Evento::findOrFail($picture->event_id);
        }
        return view('picture.show', compact('picture', 'event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'amount' => 'required|numeric',
        ]);

        $picture = Picture::findOrFail($id);
        $picture->amount = $request->input('amount');
        $picture->save();

        return redirect()->route('picture.index')->with('success', 'Fotografia Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $picture = Picture::findOrFail($id);
        $picture->delete();

        return redirect()->route('picture.index')->with('success', 'Fotografía Eliminado');
    }
}
