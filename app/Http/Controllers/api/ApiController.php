<?php

namespace App\Http\Controllers\api;
use App\CountryData;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lastUpdate=CountryData::all()->last()->date;

        $countriesInfo=DB::table('countries')
        ->select('id','name','flag_url')
        ->get();

        foreach ($countriesInfo as $countryInfo) {

            $data=DB::table('country_data')
                        ->select('date','cases','deaths','recovered')
                        ->where('date', '=', $lastUpdate)
                        ->where('country_id', '=', $countryInfo->id)
                        ->get();

        $countryInfo->data=$data;


        }
        return response()->json($countriesInfo);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $countryInfo=DB::table('countries')
        ->select('id','name','flag_url')
        ->where('countries.id', '=', $id)
        ->first();
        $countryData=DB::table('country_data')
        ->select('date','cases','deaths','recovered')
        ->where('country_id', '=', $id)
        ->get();

        $countryInfo->data=$countryData;

        return response()->json($countryInfo);
    }

}
