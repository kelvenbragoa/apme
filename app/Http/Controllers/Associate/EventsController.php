<?php

namespace App\Http\Controllers\Associate;

use App\Http\Controllers\Controller;
use App\Models\Events;
use Illuminate\Http\Request;

class EventsController extends Controller
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

        // $events = Events::orderBy('date','desc')->get()->map(function($event){
        //     return [
        //         'id'=>$event->id,
        //         'name'=>$event->name,
        //         'description'=>$event->description,
        //         'address'=>$event->address,
        //         'event_type'=>$event->event_type->name,
        //         'date'=>date('d-m-Y',strtotime($event->date)),
        //         'time'=>date('H:i',strtotime($event->time)),
        //         'user'=>$event->user->name,
        //         'created_at'=>$event->created_at->format('d-m-Y')
        //     ];
        // });


        $searchQuery = request('query');

        $events = Events::query()
        ->when(request('query'),function($query,$searchQuery){
            $query->where('name','like',"%{$searchQuery}%");
        })
        ->with('event_type')
        ->with('user')
        ->where('event_type_id',2)
        ->orderBy('date','desc')
        ->paginate();

        return $events;

}
public function show($id){
    $event = Events::with('user')->with('event_type')->find($id);
    
    $event->data_criada = $event->created_at->format('d-m-Y'); 
    $event->date = date('d-m-Y',strtotime($event->date)); 
    $event->time = date('H:i',strtotime($event->time));

    
    return $event;
}
}
