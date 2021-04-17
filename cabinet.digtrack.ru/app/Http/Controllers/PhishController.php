<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\PhishHistories;
use Carbon\Carbon;

class PhishController extends Controller{

    //  Метод который ловит инфу с фишингового сервиса
    public function pingPong(Request $request){
        $phish = PhishHistories::find($request->id);
        if($phish->hash_verification == $request->hash_verification){
            $phish->seduced = true;
            $phish->open_time = Carbon::now()->timestamp;  
        }
    }
    
}
