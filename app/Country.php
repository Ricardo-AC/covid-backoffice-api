<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = ['flag_url'];

    public function countryData()
    {
        return $this->hasMany(CountryData::class);
    }

}
