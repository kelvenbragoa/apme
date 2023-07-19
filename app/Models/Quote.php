<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function company(){
        return $this->hasOne('App\Models\Associate','id','company_id');
    }

    public function user(){
        return $this->hasOne('App\Models\User','id','user_id');
    }

    public function transaction(){
        return $this->hasMany('App\Models\Transaction', 'quote_id', 'id');
    }

    public function frequency(){
        return $this->hasOne('App\Models\PaymentFrequency', 'id', 'payment_frequency_id');
    }


   

    
}
