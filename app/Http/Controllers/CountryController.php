<?php

namespace App\Http\Controllers;

use App\Country;
use App\CountryData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show($id)
    {
        $countryData=CountryData::where('country_id', $id)->get();
        $country=Country::find($id);

        $lastDayCases=0;
        foreach ($countryData as $day){
            $cases[$day->date] = $day->cases;
            $dailyCases[$day->date]=$day->cases-$lastDayCases;
            $lastDayCases=$day->cases;
        }

        $lastDayDeaths=0;
        foreach ($countryData as $day){
            $deaths[$day->date] = $day->deaths;
            $dailyDeaths[$day->date]=$day->deaths-$lastDayDeaths;
            $lastDayDeaths=$day->deaths;
        }

        $lastDayRecovered=0;
        foreach ($countryData as $day){
            $recovered[$day->date] = $day->recovered;
            $dailyRecovered[$day->date]=$day->recovered-$lastDayRecovered;
            $lastDayRecovered=$day->recovered;
        }

        foreach ($countryData as $day){
            $recovered2 = $day->recovered;
            $cases2 = $day->cases;
            $active[$day->date]=$cases2-$recovered2;
        }
        return view('pages.country',[
            'country'=>$country,
            'active'=>$active,
            'cases'=>$cases,
            'dailyCases'=>$dailyCases,
            'deaths'=>$deaths,
            'dailyDeaths'=>$dailyDeaths,
            'recovered'=>$recovered,
            'dailyRecovered'=>$dailyRecovered
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,Request $request)
    {
        $country= new country;
        $country->name= Country::find($id)->name;
        $country->id=$id;

        $data=CountryData::where('country_id', $id)->get();
        foreach ($data as $day){
            $countryData[$day->date] = [
                'cases'=>$day->cases,
                'deaths'=> $day->deaths,
                'recovered'=>$day->recovered
            ];
        }
        $date = $request->input('date');

        $dateUpdate=CountryData::where('country_id', 1)->get();
        $dateUpdate=$dateUpdate[count($dateUpdate)-1]->date;

        return view('pages.countryEditForm',['country'=>$country,'countryData'=>$countryData,'date'=>$date,'dateUpdate'=>$dateUpdate]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        CountryData::where('date', '=', $request->date)
                    ->where('country_id',$id)
                    ->update([
                        'cases' => $request->cases,
                        'deaths' => $request->deaths,
                        'recovered' => $request->recovered
                    ]);


        $url='country/'.$id.'/edit?date='.$request->date;
        return redirect($url)->with('status','Item edited successfully!');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
