<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Teams;
use App\ClientsEmail;
use App\Company;
use Mail;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function stat()
    {
        $keys_count = Teams::all()->count(); 
        $keys_count_used = Teams::where('used', 1)->count();
        $keys_count_nonused = Teams::where('used', 0)->where('issuance', 1)->count();
        $keys_count_issuance = Teams::where('issuance', 1)->count();
        $keys_count_email = ClientsEmail::all()->count();
        return view('admin.stat', compact(
          'keys_count', 'keys_count_used', 'keys_count_nonused', 'keys_count_email', 'keys_count_issuance'
        ));
    }

    public function emails()
    {
        $emails = ClientsEmail::paginate(15);
        return view('admin.emails', compact('emails'));
    }

    public function key_list()
    {
        $keys = Teams::where('issuance', 1)
        ->select('companies.name as company_name', 'teams.*')
        ->leftJoin('companies', 'teams.company', '=', 'companies.id')
        ->paginate(15); 
        
        return view('admin.key_list', compact('keys'));
    }

    public function key_issuance()
    {
        $companies = Company::all();
        return view('admin.key_issuance', compact('companies'));
    }

    private function array2csv(array &$array)
    {
    
       if (count($array) == 0) {
         return null;
       }
       ob_start();
       $df = fopen("php://output", 'w');
       fputcsv($df, array_keys(reset($array)));
       foreach ($array as $row) {
          fputcsv($df, $row);
       }
       fclose($df);
       return ob_get_clean();
    }

    private function download_send_headers($filename) {
        // disable caching
        $now = gmdate("D, d M Y H:i:s");
        header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
        header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
        header("Last-Modified: {$now} GMT");
    
        // force download  
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
    
        // disposition / encoding on response body
        header("Content-Disposition: attachment;filename={$filename}");
        header("Content-Transfer-Encoding: binary");
    }

    public function key_issuance_heandler(Request $request)
    {
        
        $type = $request->type;
        $company = $request->company;
        $email = $request->email;
        $count = $request->count;
        
        $result = Teams::where('issuance', 0)->limit($count);
        $model = $result->select('key')->get()->toArray();    
        $result->update(['company' => $company, 'type' => $type, 'key_issuing_email' => $email, 'issuance' => 1]);

        if($count == 1){
            \Session::flash('new_key', 'Ваш ключ: <a target="_blank" href="/'.$model[0]['key'].'">'.$model[0]['key'].'</a> [ <a href="#" onclick="navigator.clipboard.writeText(\'https://'.\Request::server("HTTP_HOST").'/'.$model[0]['key'].'\')">копировать ссылку</a> | <a href="#" onclick="navigator.clipboard.writeText(\''.$model[0]['key'].'\')">копировать ключ</a> ]');
            return redirect()->route('admin-key-issuance');
        }else{
            if($email == ""){
                // dd($model);
                $data = collect($model)->map(function ($key) {
                    $key["key"] = 'https://cabinet.победи-хабиба.рф/'.$key["key"];
                    return $key;
                })->toArray();

                $this->download_send_headers("Ключи Победи Хабиба.csv");
                echo $this->array2csv($data);
            }else{
                
                $ufid = rand(1, 100000000000);
                $df = fopen('../keys_temp/'.$ufid.".csv", 'w');
                fputcsv($df, array_keys(reset($model)));
                foreach ($model as $row) {
                    fputcsv($df, $row);
                }
                fclose($df);

                //  отправляем ключи
                Mail::raw('', function($message) use ($email, $ufid) {
                    $message->to($email)->subject('Победи Хабиба Ключи');
                    $message->attach('../keys_temp/'.$ufid.'.csv');
                    $message->from('cert@побуди-хабиба.рф', 'Победи Хабиба');
                });
                return redirect()->route('admin-key-issuance');
            }
        }

        
    }


    public function company()
    {
        $companies = Company::paginate(15);
        return view('admin.company', compact('companies'));
    }


    public function add_company(){ return view('admin.add_company', compact('companies')); }
    public function add_company_heandler(Request $request){

        $new_company = new Company;
        $new_company->name = $request->name;
        $new_company->TIN = $request->TIN;
        $new_company->PSRN = $request->PSRN;
        $new_company->address = $request->address;
        $new_company->save();
        
        return redirect()->route('admin-add-company');

    }

}
