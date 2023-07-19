<?php

namespace App\Http\Controllers;

use App\Models\Associate;
use App\Models\ClassEconomicActivity;
use App\Models\PaymentFrequency;
use App\Models\Province;
use App\Models\Quote;
use App\Models\SubClassEconomicActivity;
use Illuminate\Http\Request;

class GlobalController extends Controller
{
    //
    public function province(){
        $province = Province::get();
        $frequency = PaymentFrequency::get();
        $economic = SubClassEconomicActivity::orderBy('id','asc')->get();

        return ['provinces'=>$province , 
                'frequencies'=>$frequency,
                'economicActivities' =>$economic
        ];
    }


    public function createquote(){
        $quote = Quote::orderBy('id','desc')->first();

        $id = $quote->id + 1;

        $associates = Associate::with('frequency')->orderBy('company_name','asc')->get();

        return [
            'lastquoteid'=>$id,
            'associates'=>$associates
        ];
    }

    public function activity (){
        $activity = SubClassEconomicActivity::get();
        return $activity;
    }

    public function getactivities(){
        $class = ClassEconomicActivity::get();

        return ['class'=>$class , 
               
        ];
    }

    public function storeactivity (Request $request){
        $data = $request->all();

        $clas = ClassEconomicActivity::find($data['class_economic_activity_id']);

        $sub = SubClassEconomicActivity::create([
            'service_economic_activity_id' => $clas->service_economic_activity_id,
            'division_economic_activity_id'=>$clas->division_economic_activity_id,
            'group_economic_activity_id'=>$clas->group_economic_activity_id,
            'class_economic_activity_id'=>$clas->id,
            'name'=>$data['name'],
           
        ]);

        return $clas;
    }
}
