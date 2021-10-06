<?php

namespace App\Http\Controllers;

use App\Country;
use App\CountryData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $dateUpdate=CountryData::where('country_id', 1)->get();
        $dateUpdate=$dateUpdate[count($dateUpdate)-1]->date;

        $countries=DB::table('country_data')
            ->where('date', '=', $dateUpdate)
            ->join('countries', 'countries.id', '=', 'country_data.country_id')
            ->select( 'countries.id','name','flag_url','country_data.cases','country_data.deaths','country_data.recovered')
            ->get();

        $countriesAllDates=DB::table('country_data')
            ->get();

        foreach ($countriesAllDates as $i){
            if(!isset($casesByDateEurope[$i->date])){
                $casesByDateEurope[$i->date]=0;
            }
            $casesByDateEurope[$i->date] += $i->cases;
        }

        return view('pages.index',['countries'=>$countries,'casesByDateEurope'=>$casesByDateEurope,'dateUpdate'=>$dateUpdate]);
    }

}
