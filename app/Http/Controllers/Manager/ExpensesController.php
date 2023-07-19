<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Expenses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpensesController extends Controller
{
    //
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

        $expenses = Expenses::orderBy('date','desc')->get()->map(function($expense){
            return [
                'id'=>$expense->id,
                'name'=>$expense->name,
                'amount'=>$expense->amount,
                'date'=>date('d-m-Y',strtotime($expense->date)),
                'user'=>$expense->user->name,
                'created_at'=>$expense->created_at->format('d-m-Y')
            ];
        });

        $searchQuery = request('query');

        $expenses = Expenses::query()
        ->when(request('query'),function($query,$searchQuery){
            $query->where('name','like',"%{$searchQuery}%");
        })
        ->with('user')
        ->orderBy('name','asc')
        ->paginate();


        return $expenses;

}



public function store(Request $request){
    $data = $request->all();


    $request->validate([
        'name' =>'required',
        'amount' =>'required',
        'date' =>'required|min:8',
    ]);

    $expense = Expenses::create([
        'name' => $data['name'],
        'amount' => $data['amount'],
        'date' => $data['date'],
        'user_id' => Auth::user()->id,

    ]);

    return $expense;
}





public function show($id){
    $expense = Expenses::with('user')->find($id);
    
    $expense->data_criada = $expense->created_at->format('d-m-Y'); 
    $expense->data = date('d-m-Y',strtotime($expense->date)); 

    
    return $expense;
}

public function edit($id){
    
    
    $expense = Expenses::with('user')->find($id);
    
    $expense->data = $expense->created_at->format('d-m-Y'); 

    
    return $expense;
}


public function update(Request $request){
    $data = $request->all();
    $expense = Expenses::find($data['id']);
    $request->validate([
        'name' =>'required',
        'date' =>'required',
        'amount' =>'required',
        
    ]);

    

    $expense->update([
        'name'=>$data['name'],
        'amount'=>$data['amount'],
        'date'=>$data['date'],
        'user_id' => Auth::user()->id,
        
    ]);
}


public function destroy($id){

    $expense = Expenses::find($id);

    
    $expense->delete();

    return response()->noContent();
}
}
