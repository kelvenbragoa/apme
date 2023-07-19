<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Events;
use App\Models\Expenses;
use App\Models\Quote;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //

    public function allcount(){
        $totalAdminCount = User::where('role_id',1)->count();
        $totalAssociateCount = User::where('role_id',3)->count();
        $totalManagerCount = User::where('role_id',2)->count();
        $totalUserCount = User::count();
        $expenses = Expenses::with('user')->orderBy('date','desc')->limit(10)->get();
        $totalExpenseCount = Expenses::get();
        $quotes = Quote::with('company')->with('frequency')->orderBy('id','desc')->limit(10)->get();
        $totalQuoteCount = Quote::get();
        $events = Events::get()->map(function($event){
            return [
                'title'=>$event->name,
                'date'=>$event->date,
                'start'=>$event->date.'T'.$event->time
            ];
        });


        return [
            'totalAdminCount'=>$totalAdminCount,
            'totalManagerCount'=>$totalManagerCount,
            'totalAssociateCount'=>$totalAssociateCount,
            'totalUserCount'=>$totalUserCount,
            'totalExpenseCount'=>$totalExpenseCount->count(),
            'totalExpenseAmount'=>$totalExpenseCount->sum('amount'),
            'last10expenses'=>$expenses,
            'totalQuoteCount'=>$totalQuoteCount->count(),
            'totalQuoteAmount'=>$totalQuoteCount->sum('amount'),
            'last10quotes'=>$quotes,
            'events'=>$events
        ];
    }
    public function admincount(){
        // dd(request()->all());

        $totalAdminCount = User::query()
        ->when(request('date_range') === 'total',function($query){
            
        })
        ->when(request('date_range') === 'today',function($query){
            $query->whereBetween('created_at',[now()->today(),now()]);
        })
        ->when(request('date_range') === '30',function($query){
            $query->whereBetween('created_at',[now()->subDays(30),now()]);
        })
        ->when(request('date_range') === '60',function($query){
            $query->whereBetween('created_at',[now()->subDays(60),now()]);
        })
        ->when(request('date_range') === '360',function($query){
            $query->whereBetween('created_at',[now()->subDays(360),now()]);
        })
        ->when(request('date_range') === 'monthtodate',function($query){
            $query->whereBetween('created_at',[now()->firstOfMonth(),now()]);
        })
        ->when(request('date_range') === 'yeartodate',function($query){
            $query->whereBetween('created_at',[now()->firstOfYear(),now()]);
        })
        ->where('role_id',1)
        ->count();


        return response()->json([
            'totalAdminCount'=>$totalAdminCount
        ]);
    }

    public function managercount(){
        // dd(request()->all());

        $totalManagerCount = User::query()
        ->when(request('date_range') === 'total',function($query){
            
        })
        ->when(request('date_range') === 'today',function($query){
            $query->whereBetween('created_at',[now()->today(),now()]);
        })
        ->when(request('date_range') === '30',function($query){
            $query->whereBetween('created_at',[now()->subDays(30),now()]);
        })
        ->when(request('date_range') === '60',function($query){
            $query->whereBetween('created_at',[now()->subDays(60),now()]);
        })
        ->when(request('date_range') === '360',function($query){
            $query->whereBetween('created_at',[now()->subDays(360),now()]);
        })
        ->when(request('date_range') === 'monthtodate',function($query){
            $query->whereBetween('created_at',[now()->firstOfMonth(),now()]);
        })
        ->when(request('date_range') === 'yeartodate',function($query){
            $query->whereBetween('created_at',[now()->firstOfYear(),now()]);
        })
        ->where('role_id',2)
        ->count();


        return response()->json([
            'totalManagerCount'=>$totalManagerCount
        ]);
    }

    public function associatecount(){
        // dd(request()->all());

        $totalAssociateCount = User::query()
        ->when(request('date_range') === 'total',function($query){
            
        })
        ->when(request('date_range') === 'today',function($query){
            $query->whereBetween('created_at',[now()->today(),now()]);
        })
        ->when(request('date_range') === '30',function($query){
            $query->whereBetween('created_at',[now()->subDays(30),now()]);
        })
        ->when(request('date_range') === '60',function($query){
            $query->whereBetween('created_at',[now()->subDays(60),now()]);
        })
        ->when(request('date_range') === '360',function($query){
            $query->whereBetween('created_at',[now()->subDays(360),now()]);
        })
        ->when(request('date_range') === 'monthtodate',function($query){
            $query->whereBetween('created_at',[now()->firstOfMonth(),now()]);
        })
        ->when(request('date_range') === 'yeartodate',function($query){
            $query->whereBetween('created_at',[now()->firstOfYear(),now()]);
        })
        ->where('role_id',3)
        ->count();


        return response()->json([
            'totalAssociateCount'=>$totalAssociateCount
        ]);
    }

    public function usercount(){
        // dd(request()->all());

        $totalUserCount = User::query()
        ->when(request('date_range') === 'total',function($query){
            
        })
        ->when(request('date_range') === 'today',function($query){
            $query->whereBetween('created_at',[now()->today(),now()]);
        })
        ->when(request('date_range') === '30',function($query){
            $query->whereBetween('created_at',[now()->subDays(30),now()]);
        })
        ->when(request('date_range') === '60',function($query){
            $query->whereBetween('created_at',[now()->subDays(60),now()]);
        })
        ->when(request('date_range') === '360',function($query){
            $query->whereBetween('created_at',[now()->subDays(360),now()]);
        })
        ->when(request('date_range') === 'monthtodate',function($query){
            $query->whereBetween('created_at',[now()->firstOfMonth(),now()]);
        })
        ->when(request('date_range') === 'yeartodate',function($query){
            $query->whereBetween('created_at',[now()->firstOfYear(),now()]);
        })
        ->count();


        return response()->json([
            'totalUserCount'=>$totalUserCount
        ]);
    }

    public function expensecount(){
        // dd(request()->all());

        $totalExpenseCount = Expenses::query()
        ->when(request('date_range') === 'total',function($query){
            
        })
        ->when(request('date_range') === 'today',function($query){
            $query->whereBetween('date',[now()->today(),now()]);
        })
        ->when(request('date_range') === '30',function($query){
            $query->whereBetween('date',[now()->subDays(30),now()]);
        })
        ->when(request('date_range') === '60',function($query){
            $query->whereBetween('date',[now()->subDays(60),now()]);
        })
        ->when(request('date_range') === '360',function($query){
            $query->whereBetween('date',[now()->subDays(360),now()]);
        })
        ->when(request('date_range') === 'monthtodate',function($query){
            $query->whereBetween('date',[now()->firstOfMonth(),now()]);
        })
        ->when(request('date_range') === 'yeartodate',function($query){
            $query->whereBetween('date',[now()->firstOfYear(),now()]);
        })
        ->get();


        return response()->json([
            'totalExpenseCount'=>$totalExpenseCount->count(),
            'totalExpenseAmount'=>$totalExpenseCount->sum('amount'),


        ]);
    }

    public function quotecount(){
        // dd(request()->all());

        $totalQuoteCount = Quote::query()
        ->when(request('date_range') === 'total',function($query){
            
        })
        ->when(request('date_range') === 'today',function($query){
            $query->whereBetween('created_at',[now()->today(),now()]);
        })
        ->when(request('date_range') === '30',function($query){
            $query->whereBetween('created_at',[now()->subDays(30),now()]);
        })
        ->when(request('date_range') === '60',function($query){
            $query->whereBetween('created_at',[now()->subDays(60),now()]);
        })
        ->when(request('date_range') === '360',function($query){
            $query->whereBetween('created_at',[now()->subDays(360),now()]);
        })
        ->when(request('date_range') === 'monthtodate',function($query){
            $query->whereBetween('created_at',[now()->firstOfMonth(),now()]);
        })
        ->when(request('date_range') === 'yeartodate',function($query){
            $query->whereBetween('created_at',[now()->firstOfYear(),now()]);
        })
        ->get();


        return response()->json([
            'totalQuoteCount'=>$totalQuoteCount->count(),
            'totalQuoteAmount'=>$totalQuoteCount->sum('amount'),


        ]);
    }
}
