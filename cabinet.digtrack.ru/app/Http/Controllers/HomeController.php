<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Department;
use App\Position;
use App\Customer;
use App\Scripts;
use App\TeachHistory;
use App\PhishHistory;

use Auth;
use Mail;
use Validator;

class HomeController extends Controller
{

    private function getKeys($count = 0){
        $keys = array();
        for ($i = 0; $i < $count; $i++) { 
            # code...
            $keys[] = 'RAND'.rand(1, 10).'-RAND'.rand(1, 10).'RAND';
        }
        return $keys;
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function createDepartment(Request $request){
        $department = new Department;
        $department->user_id = Auth::user()->id;
        $department->department_name = $request->department_name;
        $department->save();
        return $department;
    }

    public function allDepartments(){
        return Department::where('user_id', '=', Auth::user()->id)->get()->toJson();
    }

    public function createPosition(Request $request){
        $position = new Position;
        $position->user_id = Auth::user()->id;
        $position->position_name = $request->position_name;
        $position->save();
    }

    public function allPositions(){
        return Position::where('user_id', '=', Auth::user()->id)->get()->toJson();
    }

    public function createCustomer(Request $request){
        $customer = new Customer();
        $customer->department_id = $request->department_id;
        $customer->position_id = $request->position_id;

        $customer->first_name = $request->first_name;
        $customer->second_name = $request->second_name;
        $customer->last_name = $request->last_name;


        $customer->email_home = $request->email_home;
        $customer->email_work = $request->email_work;

        $customer->personal_phone_number = $request->personal_phone_number;
        $customer->work_phone_number = $request->work_phone_number;

        $customer->whatsapp_number = $request->whatsapp_number;
        $customer->telegram_number = $request->telegram_number;
        $customer->telegram_username = $request->telegram_username;
        $customer->vk_id = $request->vk_id;
        $customer->user_id = Auth::user()->id;
        $customer->save();
    } 

    public function allCustomers(){
        
        return Customer::where([['left', '=', false], ['customers.user_id', '=', Auth::user()->id]])
        ->select('departments.department_name', 'positions.position_name', 'customers.*')
        ->leftJoin('departments', 'customers.department_id', '=', 'departments.id')
        ->leftJoin('positions', 'customers.position_id', '=', 'positions.id')
        ->get()
        ->toJson();
    }
    
    public function scriptsList(Request $request){
        // $request->id
        return Scripts::all()->toJson();
    }

    public function selectedList(Request $request){
        // $request->id
        return Customer::where('left', '=', false)
        ->whereIn('customers.user_id', $request->ids)
        ->select('positions.position_name', 'customers.email_work', 'customers.last_name', 'customers.first_name', 'customers.second_name', 'customers.email_work' )
        ->leftJoin('positions', 'customers.position_id', '=', 'positions.id')
        ->get()
        ->toJson();
    }

    public function getCustomer(Request $request){
        $value = Customer::where('customers.id', '=', $request->id)
        ->select('departments.department_name', 'positions.position_name', 'customers.*')
        ->leftJoin('departments', 'customers.department_id', '=', 'departments.id')
        ->leftJoin('positions', 'customers.position_id', '=', 'positions.id')
        ->first();

        return $value ? $value->toJson() : null;

        

    }

    public function leftCustomer(Request $request){
        $customer = Customer::find($request->id);
        $customer->left = true;
        $customer->save();
    }

    public function getCustomersByDepartment(Request $request){
        return Customer::where('department_id', '=', $request->department_id)->andWhere('left', '=', false)->get()->toJson();
    }
    public function teachStat(Request $request){
        $customer_id = $request->id;
        return TeachHistory::where('customer_id', '=', $customer_id)
        
        ->select('scripts.*', 'teach_histories.*')
        ->leftJoin('scripts', 'teach_histories.script_id', '=', 'scripts.id')
        ->get()->toJson();
    }
    public function startTeach(Request $request){
        $ids = $request->ids;
        
        $scriptId = $request->scriptId;
        $scriptPrice = Scripts::where('id', '=', $scriptId)->first()->price;
        // Проверяем есть ли на счету пользователя такие деньги
        if(count($ids)*$scriptPrice <= Auth::user()->score){
        
            // СНимаем деньги
            Auth::user()->score -= count($ids)*$scriptPrice;

            // Получаем ключи
            $lastKeyIndex = 0;
            $keysList = $this->getKeys(count($ids));
            
            for ($i = 0; $i < count($ids); $i++) { 
                //добавляем id в историю
                $event = new TeachHistory;

                $event->user_id = Auth::user()->id;
                $event->customer_id = $ids[$i];
                $event->script_id = $scriptId;
                $event->key = $keysList[$lastKeyIndex];
                $event->date = \Carbon\Carbon::now();
                $event->save();

                // получаем id сотрудника
                $email = Customer::find($ids[$i])->email_work;
                $key   = $keysList[$lastKeyIndex];
                $data = array('key'=> $key);
                // отправляем письмо
                Mail::send(['html' => 'email.cert'], $data, function($message) use ($email) {
                    $message->to($email)->subject('Лицензионный ключ Dogital Track');
                    $message->from('cert@digtrack.ru', 'Digital Track');
                });
                $lastKeyIndex++;
            }
        }else{
            abort(404);
        }
    }


    public function startTest(Request $request){
        $ids = $request->ids;
        
        $templateId = $request->templateId;
        $scriptPrice = 100; // цена одной проверки
        // Проверяем есть ли на счету пользователя такие деньги
        if(count($ids)*$scriptPrice <= Auth::user()->score){
        
            // СНимаем деньги
            Auth::user()->score -= count($ids)*$scriptPrice;

            // Создаем тесты
            for ($i = 0; $i < count($ids); $i++) { 
                // получаем id сотрудника
                // $email = Customer::find()->email_work;

                $event = new PhishHistories();

                $table->customer_id = $ids[$i];
                $table->template_id = $templateId;
                // Добавить площадку отправления
                $table->send_time = Carbon::now()->subDays(rand(1, 10))->subHours(rand(1, 24))->subMinutes(rand(1, 60));
                $table->hash_verification = md5(rand(1, rand(1, 1000)));
                // Остлаьрое работает через крон ларавела
                // * * * * * php /var/www/www-root/data/www/cabinet.digtrack.ru/artisan schedule:run >> /dev/null 2>&1

            }

        }


    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function teach($ids)
    {
        return view('teach', ['ids' => $ids]);
    }
    public function test($ids)
    {
        return view('test', ['ids' => $ids]);
    }

    public function customer($id)
    {
        return view('customer', ['id' => $id]);
    }

    public function departments()
    {
        return view('departments');
    }
    public function statistic()
    {
        return view('statistic');
    }
    public function departmentCreate()
    {
        return view('departmentNew');
    }

    
    public function positions()
    {
        return view('positions');
    }
}
