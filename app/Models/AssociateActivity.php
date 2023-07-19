<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssociateActivity extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function activity(){
        return $this->hasOne('App\Models\SubClassEconomicActivity', 'id', 'sub_class_economic_activities_id');
    }
}
