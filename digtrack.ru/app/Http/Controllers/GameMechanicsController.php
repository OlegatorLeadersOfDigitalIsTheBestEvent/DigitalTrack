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

// Library for work with PDF files 
use setasign\Fpdi\Fpdi;

use Mail;
use Validator;

// Custom Check Rules
use App\Rules\KeyChecker;
use App\Rules\LangChecker;
use App\Rules\DayChecker;
use App\Rules\NameChecker;
use App\Rules\SurnameChecker;
use App\Rules\CardsListChecker;


class GameMechanicsController extends Controller{

    // метод для работы с ошибками
    private function validation_error($err){
        // выкидываем 404 ошибку 
        abort(404);
    }

    public function login_screen($id = null){ return view('welcome', ['id' => $id]); }
    
    public function getRandomKey(Request $request){
        return response()->json(Teams::where('used', 0)->get()->random()['key']);
    }
    public function getRatingList(Request $request){
        return response()->json(Teams::where('used', 1)->orderBy('score', 'desc')->get());
    }



    public function game_screen($key){ 

        if(Teams::where('key', '=', $key)->where('used', false)->where('ingame', true)->count()){
            $collection_for_check = Teams::where('key', $key)->first();
            
            /*
            
                Если человек не может сделать больше чем три попытки игры.
                Если человек сделал три хода и больше он уже не может использовать ключ.

            */
            
            if($collection_for_check->key_usage_count > 2 || $collection_for_check->max_step >= 3){
                // мы деактивируем игру
                Teams::where('key', $key)->update(['ingame' => false, 'used' => true, 'used_time' => \Carbon\Carbon::now()]);
                abort(404);
            }

            // если коннект не произошел, но попытки залогинеться уже были, то мы должны почистить базу от старой сессии
            if($collection_for_check->key_usage_count != 0){
                // очищаем таблицы по ключу
                SelectedCards::where('team_id', $key)->delete();
                ActiveCards::where('team_id', $key)->delete();
            }
  
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
            /*
            
                Если человек не может сделать больше чем три попытки игры.
                Если человек сделал три хода и больше он уже не может использовать ключ.

            */
            if($collection_for_check->key_usage_count > 2 || $collection_for_check->max_step >= 3){
                // мы деактивируем игру
                Teams::where('key', $request->key)->update(['ingame' => false, 'used' => true, 'used_time' => \Carbon\Carbon::now()]);
                return 0;
            }

            // логинем человека в игру
            Teams::where('key', $request->key)->update([
                'ingame'  => true, 
                'name'    => $request->name, 
                'surname' => $request->surname, 
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


    // public function newDay(Request $request){
        
    //     event(new \App\Events\NewDay(
    //         $request->day
    //     ));
    
    // }

    //->toJson();
    
    // список карт
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

   
    
    // обновление публичных новостей
    public function public_news_publication(Request $request){
       
        $day  = $request->day;

        //  получаем все приватные новости
        $news = PrivateNews::where('day', $day)
                ->where('type', 1)
                ->select('news_ru', 'type', 'description_ru')
                ->get()
                ->toJson();
        return $news;        
    }
    
    // отправление карт
    public function step(Request $request){

        $team_id = $request->team_id;
        $day     = $request->day;
        $cards   = $request->cards;

        $check = Teams::where('key', $team_id)
                ->first()
                ->toArray();

        //если хода еще не было
        if($check['step'.$day] == false){
            $newCards = [];
            $cardsList = [];
            foreach ($cards as $item) {
                $newItem = array(
                    'team_id' => $team_id,
                    'day'     => $day,
                    'card'    => $item,
                );
                $cardsList[] = $item;
                $newCards[] = $newItem;
            }

            SelectedCards::insert($newCards);

            /* Если карта есть в активных (в она обязана там быть) и она не многоразовая мы ее удаляем */
            $activeCards = ActiveCards::whereIn('active_cards.card', $cardsList)
            ->leftJoin('cards', 'cards.id', '=', 'active_cards.card')
            ->select('active_cards.*', 'cards.type')->where('cards.type', 2)
            ->delete();
          
            Teams::where('key', $team_id)->update(['step'.$day => true]);
        }
        
        Teams::where('key', $request->key)->increment('max_step');
    }

    // функция удаляет те элементы которые уже использовались
    private function card_check($new_cards, $key){
        $new_cards_return = $new_cards;
        $all_choose_cards = SelectedCards::where('team_id', $key)->get()->toArray();

        foreach ($all_choose_cards as $card_key => $card_item) {
            foreach ($new_cards as $new_card_key => $new_card_item) {
                // если значение уже было в выбранных мы его удаляем
                if($card_item['card'] == $new_card_item){
                    unset($new_cards_return[array_search($new_card_item, $new_cards_return)]);
                }
            }
        }

        // удаляем нулевые ключи
        return array_filter($new_cards_return, function($element) {
            return !empty($element);
        });
    }

    /* Ункиальные данные для каждого пользователя */
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


    public function private_news_publication(Request $request){
       
        $day  = $request->day;
        $id   = $request->team_id;

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
                ->select('news_ru', 'type', 'description_ru')
                ->get()
                ->toJson();

        return $news;    
    }


    public function get_certtificate($key){
 
        $gamer_info = Teams::where('key', $key)->first();
        $g_name = $gamer_info->name.' '.$gamer_info->surname;
        
        $im = new \Imagick('../resources/assets/pdf/cert.png');
        $draw = new \ImagickDraw();

        $draw->setFont('../resources/assets/ttf/GothaProBol.ttf');
        $draw->setFontSize(110);
        $draw->setStrokeWidth(1);
        $draw->setTextAlignment(\Imagick::ALIGN_CENTER);
        $draw->annotation(1240.5, 1700, $g_name);

        $draw->setFont('../resources/assets/ttf/GothaProReg.ttf');
        $draw->setFontSize(65);
        $draw->setStrokeWidth(1);
        $draw->setTextAlignment(\Imagick::ALIGN_CENTER);
        $draw->annotation(1240.5, 1885, $key);


        $draw->setFont('../resources/assets/ttf/GothaProBol.ttf');
        $draw->setFontSize(65);
        $color = new \ImagickPixel('#000');
        $draw->setFillColor($color);
        
        $draw->setStrokeWidth(1);
        $draw->setTextAlignment(\Imagick::ALIGN_CENTER);
        
        setlocale(LC_TIME, 'ru_RU.utf-8');
       
        $draw->annotation(1240.5, 2510, strftime("%d %b %Y г.", time()));

        $im->drawImage($draw);
        $im->writeImage('../resources/assets/pdf/'.$key.'.png');

        $pdf = new Fpdi();
        $pdf->AddPage();
        $pdf->Image('../resources/assets/pdf/'.$key.'.png', 0,0,210,297);

        // $pdf->setSourceFile('../resources/assets/pdf/'.$key.'.png');
        $pdf->Output('DigitalTrack.pdf', 'D');
    }
    public function game_rules($key){ 
        return view('rules', ['key' => $key]);
    }
    public function game_results($key){        
        // деактивируем игру
        Teams::where('key', $key)->update(['ingame' => false, 'used' => true, 'used_time' => \Carbon\Carbon::now()]);
        return view('result', ['key' => $key]);
    }
}
