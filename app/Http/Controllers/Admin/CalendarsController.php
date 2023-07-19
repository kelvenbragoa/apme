<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Events;
use Illuminate\Http\Request;

class CalendarsController extends Controller
{
    //
    public function index(){

  
        // $categories = Category::orderBy('id','desc')->get();
        // $categories = Category::orderBy('id','desc')->get()->map(function ($category) {
        //     return [
        //         'id'=>$category->id,
        //         'name'=>$category->name,
        //         'created_at'=>$category->created_at->format('d-m-Y')
        //     ];
        // });

        // return $categories;

        $events = Events::get()->map(function($event){
            return [
                'title'=>$event->name,
                'date'=>$event->date,
                'start'=>$event->date.'T'.$event->time
                
               
            ];
        });


        return $events;

}
}
