<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Events;
use App\Models\EventType;
use App\Models\User;
use App\Notifications\Operation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

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
        ->orderBy('date','desc')
        ->paginate();

        return $events;

}



public function store(Request $request){
    $data = $request->all();


    $request->validate([
        'name' =>'required',
        'description' =>'required',
        'address' =>'required',
        'date' =>'required',
        'time' =>'required',
        'event_type_id' =>'required',
       
        
    ]);

    $event = Events::create([
        'name' => $data['name'],
        'description' => $data['description'],
        'address' => $data['address'],
        'time' => $data['time'],
        'event_type_id' => $data['event_type_id'],
        'date' => $data['date'],
        'user_id' => Auth::user()->id,

    ]);

    if($data['event_type_id'] == 1){
        $user = User::where('role_id',1)->orWhere('role_id',2)->get();
    }else{
        $user = User::get();
    }

    $msg = 'Um novo evento foi criado, '.$event->name.', a decorrer no dia '.date('d M Y',strtotime($event->date)).' pelas '.date('H:i',strtotime($event->time)).'.';

    Notification::send($user,new Operation($msg));

    return $event;
}





public function show($id){
    $event = Events::with('user')->with('event_type')->find($id);
    
    $event->data_criada = $event->created_at->format('d-m-Y'); 
    $event->date = date('d-m-Y',strtotime($event->date)); 
    $event->time = date('H:i',strtotime($event->time));

    
    return $event;
}

public function edit($id){
    
    
    $event = Events::with('user')->with('event_type')->find($id);
    $user = Auth::user();
    
    $event->time = date('H:i',strtotime($event->time));
    $type_event = EventType::get();

    
    return [
        'event'=>$event,
        'type_event'=>$type_event
    ];
}


public function update(Request $request){
    $data = $request->all();
    $event = Events::find($data['id']);

    $request->validate([
        'name' =>'required',
        'description' =>'required',
        'address' =>'required',
        'date' =>'required',
        'time' =>'required',
        'event_type_id' =>'required',
       
        
    ]);

    

    $event->update([
        'name' => $data['name'],
        'description' => $data['description'],
        'address' => $data['address'],
        'time' => $data['time'],
        'event_type_id' => $data['event_type_id'],
        'date' => $data['date'],
        'user_id' => Auth::user()->id,
        
    ]);

    return $event;
}


public function destroy($id){

    $event = Events::find($id);

    
    $event->delete();

    return response()->noContent();
}
}
