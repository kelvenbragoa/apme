<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Associate extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function province(){
        return $this->hasOne('App\Models\Province', 'id', 'province_id');
    }

    public function frequency(){
        return $this->hasOne('App\Models\PaymentFrequency', 'id', 'payment_frequency_id');
    }

    public function activity(){
        return $this->hasMany('App\Models\AssociateActivity', 'associate_id', 'id');
    }


}
