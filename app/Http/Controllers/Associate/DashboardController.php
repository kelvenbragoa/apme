<?php

namespace App\Http\Controllers\Associate;

use App\Http\Controllers\Controller;
use App\Models\Events;
use App\Models\Quote;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //
    public function index(){

        $user_data = User::with('role')->with('associatecompany')->with('associatecompany.province')->with('associatecompany.frequency')->find(Auth::user()->id);
        $quotes = Quote::with('company')->with('frequency')->orderBy('id','desc')->where('user_id',Auth::user()->id)->limit(10)->get();
        $events = Events::where('event_type_id',2)->get()->map(function($event){

            return [
                'title'=>$event->name,
                'date'=>$event->date,
                'start'=>$event->date.'T'.$event->time
            ];
        });

        $status = 0;


        $quote_test = Quote::where('user_id',Auth::user()->id)->where('status',0)->get();

        if($quote_test->count() == 0){
            $status = 1;
        }else{
            $status = 0;
        }

    



        return [
            'user_info'=>$user_data,
            'last10quotes'=>$quotes,
            'events'=>$events,
            'status'=>$status
        ];

    }

}
