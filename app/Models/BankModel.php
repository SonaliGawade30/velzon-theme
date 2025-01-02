<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankModel extends BaseModel
{
    use HasFactory;

    protected $table ='bank';
    
    protected $fillable=[
        'holdername',
        'accountnumber',
        'ifsccode',
        'country_id',
         'state_id',
         'city_id', 
         'image',
          'technologies',
          'process'
    ];
    
    protected $casts = [
        // 'technologies' => 'array', // This will automatically cast it to an array
        'process' => 'array',
    ];

    public function bank()
    {
        return $this->hasMany(BankModel::class, 'bank_id');
    }
    

    // Define relationships to Country, State, and City
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
    
    public function addmo()
    {
        return $this->hasMany(Addmore::class,'bank_id');
    }
    
}
