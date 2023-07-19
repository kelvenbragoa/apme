<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminsController extends Controller
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

            // $admins = User::where('role_id',1)->orderBy('name','asc')->paginate(3)->map(function($admin){
            //     return [
            //         'id'=>$admin->id,
            //         'name'=>$admin->name,
            //         'role'=>$admin->role->name,
            //         'mobile'=>$admin->mobile,
            //         'email'=>$admin->email,
            //         'created_at'=>$admin->created_at->format('d-m-Y')
            //     ];
            // });

            // $admins = User::where('role_id',1)->with('role')->orderBy('name','asc')->paginate();

            $searchQuery = request('query');

            $admins = User::query()
            ->when(request('query'),function($query,$searchQuery){
                $query->where('name','like',"%{$searchQuery}%");
            })
            ->where('role_id',1)
            ->with('role')
            ->orderBy('name','asc')
            ->paginate();


            return $admins;
    
    }



    public function store(Request $request){
        $data = $request->all();


        $request->validate([
            'name' =>'required',
            'email' =>'required|unique:users,email',
            'password' =>'required|min:8',
            'mobile' =>'required|min:9',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'mobile' => $data['mobile'],
            'role_id' => 1,
            'lang' => 'pt',
            'password' => bcrypt($data['password']),
        ]);

        return $user;
    }



  

    public function show($id){
        $user = User::with('role')->find($id);
        
        $user->data = $user->created_at->format('d-m-Y'); 

        
        return $user;
    }

    public function edit($id){
        $user = User::with('role')->find($id);
        
        $user->data = $user->created_at->format('d-m-Y'); 

        
        return $user;
    }


    public function update(Request $request){
        $data = $request->all();
        $user = User::find($data['id']);
        $request->validate([
            'name' =>'required',
            'email' =>'required|unique:users,email,'.$user->id,
            'password' =>'sometimes|min:8',
            'mobile' =>'required|min:9',
        ]);

        

        $user->update([
            'name'=>$data['name'],
            'mobile'=>$data['mobile'],
            'email'=>$data['email'],
            'password' => request('passwprd') ? bcrypt($data['password']) : $user->password
        ]);
    }


    public function destroy($id){
        $user = User::find($id);

        if(Auth::user()->id == $user->id){
            return abort(402,'Erro') ;
        }
        $user->delete();

        return response()->noContent();
    }

    // public function search(Request $request)
    // {
        
    //     $data = $request->all();
    //     $searchQuery = $data['query'];

    //     // $admins = User::where('role_id',1)->where('name','like',"%{$searchQuery}%")->orderBy('name','asc')->get()->map(function($admin){
    //     //     return [
    //     //         'id'=>$admin->id,
    //     //         'name'=>$admin->name,
    //     //         'role'=>$admin->role->name,
    //     //         'mobile'=>$admin->mobile,
    //     //         'email'=>$admin->email,
    //     //         'created_at'=>$admin->created_at->format('d-m-Y')
    //     //     ];
    //     // });
    //     $admins = User::where('role_id',1)->where('name','like',"%{$searchQuery}%")->with('role')->orderBy('name','asc')->paginate();

    //     return $admins;
    // }
}
