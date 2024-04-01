<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Average_monthly_exchange_rates;
use App\Models\Currency_index;
use App\Models\Inflation;
use App\Models\Interest_rates;
use App\Models\Pko_bp_settlement;
use Illuminate\Http\Request;

class LoadDataController extends Controller
{
    public function index(){
        $average_montly = Average_monthly_exchange_rates::all();
        $currency_index = Currency_index::all();
        $inflation = Inflation::all();
        $interest_rates = Interest_rates::all();
        $pko = Pko_bp_settlement::all();
        return response()->json(compact("average_montly", "currency_index", "inflation", "interest_rates", "pko"));
    }
}
