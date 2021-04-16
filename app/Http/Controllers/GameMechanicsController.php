<?php

namespace App\Http\Controllers;
use DB;

use Illuminate\Http\Request;
use App\Teams;
use App\PublicNews;
use App\PrivateNews;
use App\Cards;
use App\SelectedCards;
use App\ActiveCards;
use App\StepCards;
use App\ClientsEmail;


use Mail;
use Validator;

class GameMechanicsController extends Controller{
    public function login_screen($id = null){ return view('welcome', ['id' => $id]); }
    public function game_screen($lang, $key){ 
        // если ключ есть ок
        if(Teams::where('key', '=', $key)->where('used', false)->where('ingame', true)->count()){
            $collection_for_check = Teams::where('key', $key)->first();
            Teams::where('key', $key)->update([
                'score' => 800,
                'max_step' => 0,
                'step1' => 0,
                'step2' => 0,
                'step3' => 0,
                'step4' => 0,
                'step5' => 0,

            ]);
            
            Teams::where('key', $key)->increment('key_usage_count');

            return view('game', ['key' => $key]);
        }else{
            abort(404);
        }    
    }
    // проверяем ключ для интерфейса лагина
    public function check_key(Request $request){
        if($request->key == ""){ return 0; }
        if(Teams::where('key', '=', $request->key)->where('used', false)->count()){
            return 1;
        }else{
            return 0;
        }
    }
    
    public function newTeamConnect(Request $request){
        if(Teams::where('key', '=', $request->key)->where('used', false)->count()){
            
            $collection_for_check = Teams::where('key', $request->key)->first();
            
            // логинем человека в игру
            Teams::where('key', $request->key)->update([
                'ingame'  => true, 
                'name'    => $request->name, 
                'surname' => $request->surname, 
                'lang'    => $request->lang,
            ]);
            
            return 1;
        }else{
            return 0;
        }        
    }
}
