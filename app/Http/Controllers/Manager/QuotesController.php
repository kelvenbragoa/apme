<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Associate;
use App\Models\Configuration;
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

        // $quotes = Quote::orderBy('created_at','desc')->get()->map(function($quote){
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
                // $query->where('name','like',"%{$searchQuery}%");
                $query->whereRelation('company','company_name','like',"%{$searchQuery}%");
            })
           
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
        'obs'=>'required'
    ]);
    $config = Configuration::first();

    $refquote = Quote::orderBy('id','desc')->first();

    $refid = $refquote->id + 1;

    $ref = "APME-QUOTA-$refid";

    $associate = Associate::with('frequency')->find($data['company_id']);
    $user = User::where('company_id',$associate->id)->first();
    $lastquote = Quote::with('frequency')->with('company')->where('company_id',$data['company_id'])->orderBy('id')->first();
    $months = $associate->frequency->months;
    if($lastquote == null){
        $start_date = date('Y-m-d');
        $end_date = date('Y-m-d', strtotime("+$months months", strtotime($start_date)));
        // $end_date = now()->addMonths($months);

    }else{
        $start_date = $lastquote->end_date;
        $end_date = date('Y-m-d', strtotime("+$months months", strtotime($lastquote->end_date)));
    }


    $quote = Quote::create([
        'ref' => $ref,
        'user_id' => $user->id,
        'company_id' => $associate->id,
        'payment_frequency_id' => $associate->payment_frequency_id,
        'amount' => $config->quote_amount * $months,
        'end_date' => $end_date,
        'start_date' => $start_date,
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
    
    
    $quote = Quote::with('user')->with('company.province')->with('transaction')->with('frequency')->find($id);
    

    
    return $quote;
}


public function update(Request $request){
    $data = $request->all();
    $quote = Quote::find($data['id']);

   

    

    $quote->update([
        'payment_date' => $data['payment_date'],
        'payment_ref' => $data['payment_ref'],
        'status' => 1,
       
        
    ]);

    return $quote;
}


public function destroy($id){

    $quote = Quote::find($id);

    
    $quote->delete();

    return response()->noContent();
}



public function getCompanyInfo($id){
    $associate = Associate::with('frequency')->find($id);
    $lastquote = Quote::with('frequency')->with('company')->where('company_id',$id)->orderBy('id')->first();
    $months = $associate->frequency->months;

    


    if($lastquote == null){
        $start_date = date('d-m-Y');
        $end_date = now()->addMonths($months);
        $formatted_Date = date('d-m-Y',strtotime($end_date));
        $quote = "Esta empresa ainda não tem nenhuma quota gerada no sistema. A fatura da quota será a partir da data actual, $start_date até $formatted_Date .";
        $msg = $quote;
        $table_status = 0;
    }else{
        $msg = "Esta empresa contém uma fatura da quota gerada. Abaixo os dados da fatura anterior.";
        $quote = $lastquote;
        $start_date = date('d-m-Y',strtotime($lastquote->end_date));
        $end_date = date('Y-m-d', strtotime("+$months months", strtotime($lastquote->end_date)));
        $table_status = 1;
    }


    
    return [
        'associate' => $associate,
        'lastquote' => $quote,
        'start_date' => $start_date,
        'end_date' => $end_date,
        'msg' => $msg,
        'table_status'=>$table_status
    
    ];
}
}
