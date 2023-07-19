<?php

namespace App\Http\Controllers\Associate;

use App\Http\Controllers\Controller;
use App\Models\Associate;
use App\Models\Quote;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuotesController extends Controller
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

        // $quotes = Quote::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->get()->map(function($quote){
        //     return [
        //         'id'=>$quote->id,
        //         'ref'=>$quote->ref,
        //         'company_name'=>$quote->company->company_name,
        //         'company_invoice_name'=>$quote->company->invoice_name,
        //         'company_invoice_email'=>$quote->company->invoice_email,
        //         'company_invoice_mobile'=>$quote->company->invoice_mobile,
        //         'user_name'=>$quote->user->name,
        //         'user_email'=>$quote->user->email,
        //         'frequency'=>$quote->frequency->name,
        //         'amount'=>$quote->amount,
        //         'start_date'=>date('d-m-Y',strtotime($quote->start_date)),
        //         'end_date'=>date('d-m-Y',strtotime($quote->end_date)),
        //         'status'=>$quote->status == 1 ? 'Pago' : 'Não pago',
                
        //     ];
        // });


        // return $quotes;
        $searchQuery = request('query');

            $quotes = Quote::query()
            ->when(request('query'),function($query,$searchQuery){
                $query->where('ref','like',"%{$searchQuery}%");
                // $query->whereRelation('company','company_name','like',"%{$searchQuery}%");
            })
            ->where('user_id',Auth::user()->id)
            ->with('company')
            ->with('user')
            ->with('frequency')
            ->orderBy('end_date','desc')
            ->paginate();


    


        return $quotes;


}



public function store(Request $request){
    $data = $request->all();


    $request->validate([
        'ref' =>'required',
        'company_id' =>'required',
        'amount' =>'required',
        'end_date' =>'required',
        'obs'=>'required'
       
        
    ]);

    $associate = Associate::find($data['company_id']);
    $user = User::where('company_id',$associate->id)->first();

    $quote = Quote::create([
        'ref' => $data['ref'],
        'user_id' => $user->id,
        'company_id' => $associate->id,
        'payment_frequency_id' => $associate->payment_frequency_id,
        'amount' => $data['amount'],
        'end_date' => $data['end_date'],
        'start_date' => date('Y-m-d'),
        'status' => 0,
        'obs' => $data['obs'],
        

    ]);

    // if($data['event_type_id'] == 1){
    //     $user = User::where('role_id',1)->orWhere('role_id',2)->get();
    // }else{
    //     $user = User::get();
    // }

    // $msg = 'Um novo evento foi criado, '.$quote->name.', a decorrer no dia '.date('d M Y',strtotime($quote->date)).' pelas '.date('H:i',strtotime($quote->time)).'.';

    // Notification::send($user,new Operation($msg));

    return $quote;
}





public function show($id){
    $quote = Quote::with('user')->with('company.province')->with('transaction')->with('frequency')->find($id);
    
    // $quote->data_criada = $quote->created_at->format('d-m-Y'); 
    // $quote->date = date('d-m-Y',strtotime($quote->date)); 
    // $quote->time = date('H:i',strtotime($quote->time));

    
    return $quote;
}

public function edit($id){
    
    
    $quote = Quote::with('user')->with('company')->with('transaction')->with('frequency')->find($id);
    

    
    return [
        'quote'=>$quote,
        
    ];
}


public function update(Request $request){
    $data = $request->all();
    $quote = Quote::find($data['id']);

    $request->validate([
        'name' =>'required',
        'description' =>'required',
        'address' =>'required',
        'date' =>'required',
        'time' =>'required',
        'event_type_id' =>'required',
       
        
    ]);

    

    $quote->update([
        'name' => $data['name'],
        'description' => $data['description'],
        'address' => $data['address'],
        'time' => $data['time'],
        'event_type_id' => $data['event_type_id'],
        'date' => $data['date'],
        'user_id' => Auth::user()->id,
        
    ]);

    return $quote;
}


public function destroy($id){

    $quote = Quote::find($id);

    
    $quote->delete();

    return response()->noContent();
}
}
