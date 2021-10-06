<?php

namespace App\Http\Controllers;

use App\Country;
use App\CountryData;
use Illuminate\Support\Facades\DB;

class ResetDBController extends Controller
{
    public function country(){

        $json = file_get_contents('https://corona.lmao.ninja/v2/countries');
        $countriesObj = json_decode($json,false);

        foreach ($countriesObj as $countryObj){
            if($countryObj->continent=="Europe"){
                $country           = new Country;
                $country->name     = $countryObj->country;
                $country->flag_url = $countryObj->countryInfo->flag;
                $country->lat      = $countryObj->countryInfo->lat;
                $country->long     = $countryObj->countryInfo->long;
                $country->save();}
        }
        return "done";
    }
    public function data(){
        set_time_limit(300);
        $countries=DB::table('countries')->select('id','name')->get();
        CountryData::truncate();
        foreach ($countries as $country) {

            $json = file_get_contents('https://corona.lmao.ninja/v2/historical/' . $country->name . '?lastdays=all');
            $data = json_decode($json);

            $days = $data->timeline->cases;
            $recovered=0;
            foreach ($days as $day => $cases) {
                $deaths = $data->timeline->deaths->$day;

                if($data->timeline->recovered->$day!=0){
                    $recovered =$data->timeline->recovered->$day;
                }
                $countryData = new CountryData;
                $countryData->country_id = $country->id;
                $dateArray=explode("/", $day);
                if (strlen($dateArray[0])==1){
                    $dateArray[0]="0".$dateArray[0];
                }
                if (strlen($dateArray[1])==1){
                    $dateArray[1]="0".$dateArray[1];
                }

                $countryData->date = "20".$dateArray[2]."-".$dateArray[0]."-".$dateArray[1];
                $countryData->cases = $cases;
                $countryData->deaths = $deaths;
                $countryData->recovered = $recovered;
                $countryData->save();
            }
        }

        return "done";

    }





}
