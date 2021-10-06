<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CountryData extends Model
{
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
}
