<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;


use App\PhishHistory;


class Kernel extends ConsoleKernel
{
    private $access_token = "05209b9869bf1a3b54ac3564fa31fbce767261dd75362b3ae0d8fad657ca39af5b6f9b4d0029f3bcfe6ec";
   
    private function sendMessage($userId, $message){
        $url = 'https://api.vk.com/method/messages.send';
        $params = array(
            'token' => $this->access_token,
            'user_id' => $userId, // в http://localhost/post.php это будет $_POST['param1'] == '123'
            'message' => $message, // в http://localhost/post.php это будет $_POST['param2'] == 'abc'
        );
        $result = file_get_contents($url, false, stream_context_create(array(
            'http' => array(
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => http_build_query($params)
            )
        )));
        echo $result;
        return $result;
    }

    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule){
        // Каждую минуту чекаем новые записи и после запускаем рассылку по ним


        $schedule->call(function () {


            // Лист для рассылки
            // https://oauth.vk.com/blank.html#access_token=05209b9869bf1a3b54ac3564fa31fbce767261dd75362b3ae0d8fad657ca39af5b6f9b4d0029f3bcfe6ec&expires_in=86400&user_id=547397955
            $list = PhishHistory::where('send_time', '=', \Carbon\Carbon::now()->second(0))->get();
            $userId = 206876779;
            $message = "Поля, привет!";
            $this->sendMessage($userId, $message);
        
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
