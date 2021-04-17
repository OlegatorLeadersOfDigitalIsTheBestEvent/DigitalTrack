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
    // информация о командах и обновление
    public function dynamic(Request $request){
        return Teams::where('key', '=', $request->key)->select(
            'step1_user_result', 'step1_max_result',
            'step2_user_result', 'step2_max_result',
            'step3_user_result', 'step3_max_result',
            'step4_user_result', 'step4_max_result',
            'step5_user_result', 'step5_max_result'
        )->first()->toJson();
    }
    
    // обновление публичных новостей
    public function public_news_publication(Request $request){
        $day  = $request->day;
        $lang = $request->lang;

        //  получаем все приватные новости
        $news = PrivateNews::where('day', $day)
                ->where('type', 1)
                ->select('news_'.$lang, 'type', 'description_'.$lang)
                ->get()
                ->toJson();
        return $news;        
    }
    
    
    public function private_news_publication(Request $request){
        $day  = $request->day;
        $id   = $request->team_id;
        $lang = $request->lang;

        // сначала получаем все приватные новости
        $whereIn = [0];
        $all_cards = SelectedCards::where('team_id', $id)
                    ->where('day', ($day-1))
                    ->select('card')
                    ->get()
                    ->toArray();
        
        foreach ($all_cards as $key => $card) {
            $whereIn[] = $card['card'];
        }

        //  получаем все приватные новости
        $news = PrivateNews::where('day', $day)
                ->where('type', 2)
                ->whereIn('visible', $whereIn)
                ->select('news_'.$lang, 'type', 'description_'.$lang)
                ->get()
                ->toJson();

        return $news;    
    }
    
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
    
    // получение публичных новостей
    // private function getNewsByDay($day){
    //     return PublicNews::where('day', $day)->select('news', 'type', 'description')->first()->toJson();
    // }

    // private function getPrivateNewsByDay($day){
    //     return PrivateNews::where('day', $day)->get()->toJson();
    // }
    
}
