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
    
    private function listOfValidCommans(){ 
        return Teams::select('team_number', 'connection_status', 'lang')
        ->get()->toJson();
    }
    
    private function cardsList($id){
        return Cards::whereIn('cards.id', $id)
        ->leftJoin('card_types', 'card_types.id', '=', 'cards.type')
        ->select('card_types.*', 'cards.*')->addSelect(DB::raw("false as active"))->get()
        ->toJson();
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
    private function getNewsByDay($day){
        return PublicNews::where('day', $day)->select('news', 'type', 'description')->first()->toJson();
    }

    // private function getPrivateNewsByDay($day){
    //     return PrivateNews::where('day', $day)->get()->toJson();
    // }
    
    public function newcards(Request $request){
        // идентификатор команды в переборе
        $id  = $request->team_id; 
        $day = $request->day;

        // получаем карты выдачи на ход
        $day_cards = StepCards::where('day', $day)->get();
    
        // проверяем есть есть карты  для  выдачи на ход, 
        // то мы их пушим в активные карты
        if($day_cards->count() > 0){

            // начальные карты
            $db_cards_list = [];
            foreach ($day_cards as $item) {
                $newItem = array(
                    'team_id' => $id,
                    // $item->day
                    'day'     => $item->day, // BEFORE WAS $item->id
                    'card'    => $item->card,
                );
                $db_cards_list[] = $newItem;
            }
            
            ActiveCards::insert($db_cards_list);
        }

        $cards = ActiveCards::where('team_id', $id)->get()->toArray();
        $card_for_sending = [];
        foreach ($cards as $key => $card) { 
            $card_for_sending[] = $card['card'];
        }
        
        return $this->cardsList($card_for_sending);
    }
    
    public function day_result(Request $request){
        // сегодняшний день
        $day = $request->day;
        $id  = $request->team_id;

        // максимальная сумма заработанных денег командой за ход
        $value = 1200;
        
        $step_save_cashloss = 0;
        $step_max_cashloss = 0;

        $team = Teams::where('key', $id)->select('score')->first()->toArray();
        $old_score = $team['score'];

        // карты которые команда получит на следующий ход 
        $newCards =  [];
        // получаем все выбранные командой карты
        $all_choose_cards = SelectedCards::where('team_id', $id)->get()->toArray();
        $all_choose_cards_arr = [];
        
        // провращяем коллеккцию в массив
        foreach($all_choose_cards as $all_choose_cards_key => $all_choose_cards_item){
            $all_choose_cards_arr[] = $all_choose_cards_item['card'];
        }

        // получаем все проблемы
        $all_issues = PrivateNews::all()->toArray();

        // проходимся  по каждой проблеме
        foreach ($all_issues as $issue_key => $issue) {
            
            if($issue['solution'] != null && $issue['day'] == $day){
                // массив решений проходимся по каждому элементу и изем его в картах дня
                $arr_solution = explode(',', $issue['solution']);
                
                foreach($arr_solution as $solution_key => $solution_item){
                    if(in_array($solution_item, $all_choose_cards_arr)){
                        // правильное решение есть
                        if($issue['outcomes_good'] != null){ 
                            $arr_outcomes_good = explode(',', $issue['outcomes_good']);
                            foreach ($arr_outcomes_good as $insert_value) {
                                $newCards[] = intval($insert_value); 
                            }
                        }
                        $step_save_cashloss += $issue['cash_loss'];
                    }else{
                        // правильного решения нет
                        
                        if($issue['outcomes_bad'] != null){ 
                            $arr_outcomes_bad  = explode(',', $issue['outcomes_bad']);
                            foreach ($arr_outcomes_bad as $insert_value) {
                                $newCards[] = intval($insert_value); 
                            }
                        }
                        
                        // вычитаем деньги из счета команды
                        $value -= $issue['cash_loss'];
                    }
                    $step_max_cashloss += $issue['cash_loss'];
                }
            }
            

            // ------------------ СТАРАЯ ВЕРСИЯ ----------------- //
            /*
                Максимально можно привязать к проблеме три правильные карты 
            */
            /*
            if($issue['solution'] != null && $issue['day'] == $day){

                $arr_solution = explode(',', $issue['solution']);
                
                // флаг правильности
                $result = false;

                // день выбора
                $day_of_choose = null;

                // работоспособность конструкции под вопросом
                // хз что проичходит когда карт несколько а интсрукция сбросилась
                foreach ($all_choose_cards as $card_key => $card_item) {
                    if(in_array($card_item['card'], $arr_solution)){
                        $result = true;
                        $day_of_choose = $card_item['day'];
                        break;
                    }
                }

                if($result){
                    // если есть карты для выдачи мы их выдем
                    if($issue['outcomes_good'] != null){ 
                        $arr_outcomes_good = explode(',', $issue['outcomes_good']);
                        foreach ($arr_outcomes_good as $insert_value) {
                            $newCards[] = intval($insert_value); 
                        }
                    }
                    $step_save_cashloss += $issue['cash_loss'];
                }else{
                    // карта НЕ выбрана
                    // если есть карты для выдачи мы их выдем
                    if($issue['outcomes_bad'] != null){ 
                        $arr_outcomes_bad  = explode(',', $issue['outcomes_bad']);
                        foreach ($arr_outcomes_bad as $insert_value) {
                            $newCards[] = intval($insert_value); 
                        }
                    }
                    
                    // вычитаем деньги из счета команды
                    $value -= $issue['cash_loss'];
                    
                }
                $step_max_cashloss += $issue['cash_loss'];
               
            } */
            // ------------------ СТАРАЯ ВЕРСИЯ ----------------- //
        }

        // записываем все новые карты в БД
        // id == team_id == key
        $new_cards = $this->card_check($newCards, $id);
        $db_cards_list = [];
        
        foreach ($newCards as $item) {
            $newItem = array(
                'team_id' => $id,
                // before was ++$day 
                'day'     => ($day+1),
                'card'    => $item,
            );
            $db_cards_list[] = $newItem;
        }

        ActiveCards::insert($db_cards_list);
        $newScore = $old_score + $value;
        // обновляем счет
        Teams::where('key', $id)->update(['score' => $newScore, 'step'.$day.'_user_result' => $step_save_cashloss, 'step'.$day.'_max_result' => $step_max_cashloss]);
        return $newScore;
    }
    
    public function game_rules($lang, $key){ 
        return view('rules', ['key' => $key, 'lang' => $lang]);
    }

    // вьюха с результатами
    public function game_results($lang, $key){ 
          
        // if(!Teams::where('key', '=', $key)->where('used', false)->count()){ abort(404); };

        // деактивируем игру
        Teams::where('key', $key)->update(['ingame' => false, 'used' => true, 'used_time' => \Carbon\Carbon::now()]);
        return view('result', ['key' => $key, 'lang' => $lang]);
    }
}
