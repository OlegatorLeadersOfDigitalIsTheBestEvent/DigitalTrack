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

}
