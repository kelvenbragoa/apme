<?php

namespace App\Http\Controllers\Associate;

use App\Http\Controllers\Controller;
use App\Models\Associate;
use App\Models\AssociateActivity;
use App\Models\PaymentFrequency;
use App\Models\Province;
use App\Models\SubClassEconomicActivity;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssociatesController extends Controller
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

        // $associates = User::where('role_id',3)->orderBy('name','asc')->get()->map(function($associate){
        //     return [
        //         'id'=>$associate->id,
        //         'name'=>$associate->name,
        //         'role'=>$associate->role->name,
        //         'mobile'=>$associate->mobile,
        //         'email'=>$associate->email,
        //         'created_at'=>$associate->created_at->format('d-m-Y')
        //     ];
        // });

        $searchQuery = request('query');

        $associates = User::query()
        ->when(request('query'),function($query,$searchQuery){
            $query->where('name','like',"%{$searchQuery}%");
        })
        ->where('role_id',3)
        ->with('role')
        ->orderBy('name','asc')
        ->paginate();


        return $associates;

}



public function store(Request $request){
    $data = $request->all();

    // dd($data1);
    // // dd($data['_rawValue'][1]);
    // $data = $data1['_rawValue'][0];
    // $data2 = $data1['_rawValue'][1];

    // foreach ($data2 as $item){
    //     dd($item['id']);
    // }

  
    

    if(!isset($data['activities'])){
        abort(500,'Por favor adicione as actividades da empresa');
        
    };


    $request->validate([
        'company_name' =>'required',
        'address' =>'required',
        'accession_date' =>'required',
        'mobile' =>'required',
        'fax' =>'required',
        'province_id' =>'required',
        'payment_frequency_id' =>'required',
        'email' =>'required',
        'date_statute' =>'required',
        'number_statute' =>'required',
        'company_goals' =>'required',
        'representative_name' =>'required',
        'representative_email' =>'required',
        'representative_mobile' =>'required',
        'representative_cellphone' =>'required',
        'representative_role' =>'required',
        'nuit'=>'required',
        'invoice_mobile'=>'required',
        'invoice_name'=>'required',
        'invoice_email'=>'required',
        'user_email' =>'required|unique:users,email',
        'password' =>'required|min:8',
        
    ]);

 

    $associate_company = Associate::create([
        'associate_number' => $data['associate_number'],
        'company_name' => $data['company_name'],
        'address' => $data['address'],
        'province_id' => $data['province_id'],
        'payment_frequency_id' => $data['payment_frequency_id'],
        'accession_date' => $data['accession_date'],
        'mobile' => $data['mobile'],
        'fax' => $data['fax'],
        'email' => $data['email'],
        'date_statute' => $data['date_statute'],
        'number_statute' => $data['number_statute'],
        'company_goals' => $data['company_goals'],
        'representative_name' => $data['representative_name'],
        'representative_email' => $data['representative_email'],
        'representative_mobile' => $data['representative_mobile'],
        'representative_cellphone' => $data['representative_cellphone'],
        'representative_role' => $data['representative_role'],
        'nuit' => $data['nuit'],
        'invoice_mobile' => $data['invoice_mobile'],
        'invoice_name' => $data['invoice_name'],
        'invoice_email' => $data['invoice_email'],
        'status'=>0
    ]);

    $user = User::create([
        'name' => $data['company_name'],
        'email' => $data['user_email'],
        'mobile' => $data['mobile'],
        'role_id' => 3,
        'company_id' => $associate_company->id,
        'lang' => 'pt',
        'password' => bcrypt($data['password']),
    ]);

    foreach ( $data['activities'] as $item){

        $test = AssociateActivity::where('associate_id',$associate_company->id)->where('sub_class_economic_activities_id',$item['name'])->first();

        if($test==null){

        
            AssociateActivity::create([
                'associate_id'=>$associate_company->id,
                'sub_class_economic_activities_id'=>$item['name']
            ]);
        }

        
    }

    return [$user,$associate_company];
}





public function show($id){
    // $user = User::with('role')->find($id);
    
    // $user->data = $user->created_at->format('d-m-Y'); 

    $associate = User::with('role')->with('associatecompany')->with('associatecompany.province')->with('associatecompany.frequency')->find(Auth::user()->id);
    $activity = AssociateActivity::where('associate_id',$associate->company_id)->with('activity')->get();

    
    return [
        'associate'=>$associate,
        'activity'=>$activity,
    ];
}

public function edit($id){

    $associate = User::with('role')->with('associatecompany')->with('associatecompany.province')->with('associatecompany.frequency')->find(Auth::user()->id);
    $province = Province::get();
    $frequency = PaymentFrequency::get();
    $activity = AssociateActivity::where('associate_id',$associate->company_id)->with('activity')->get();
    $economicActivities = SubClassEconomicActivity::orderBy('id','asc')->get();

   

    return [
        
            'provinces'=>$province, 
            'frequencies'=>$frequency,
            'associate'=>$associate,
            'activity'=>$activity,
            'economicActivities'=>$economicActivities
    ];

}


public function update(Request $request){
    $data = $request->all();
    $user = User::find($data['id']);
    $company = Associate::find($user->company_id);
 
    $request->validate([
        'company_name' =>'required',
        'address' =>'required',
        'accession_date' =>'required',
        'mobile' =>'required',
        'fax' =>'required',
        'province_id' =>'required',
        'payment_frequency_id' =>'required',
        'email' =>'required',
        'date_statute' =>'required',
        'number_statute' =>'required',
        'company_goals' =>'required',
        'representative_name' =>'required',
        'representative_email' =>'required',
        'representative_mobile' =>'required',
        'representative_cellphone' =>'required',
        'representative_role' =>'required',
        'nuit'=>'required',
        'invoice_mobile'=>'required',
        'invoice_name'=>'required',
        'invoice_email'=>'required',
        'user_email' =>'required',
        'password' =>'sometimes|min:8',
        
    ]);

    $company->update([
        'associate_number' => $data['associate_number'],
        'company_name' => $data['company_name'],
        'address' => $data['address'],
        'province_id' => $data['province_id'],
        'payment_frequency_id' => $data['payment_frequency_id'],
        'accession_date' => $data['accession_date'],
        'mobile' => $data['mobile'],
        'fax' => $data['fax'],
        'email' => $data['email'],
        'date_statute' => $data['date_statute'],
        'number_statute' => $data['number_statute'],
        'company_goals' => $data['company_goals'],
        'representative_name' => $data['representative_name'],
        'representative_email' => $data['representative_email'],
        'representative_mobile' => $data['representative_mobile'],
        'representative_cellphone' => $data['representative_cellphone'],
        'representative_role' => $data['representative_role'],
        'nuit' => $data['nuit'],
        'invoice_mobile' => $data['invoice_mobile'],
        'invoice_name' => $data['invoice_name'],
        'invoice_email' => $data['invoice_email'],
    ]);

  

    

    $user->update([
        'email'=>$data['user_email'],
        'password' => request('passwprd') ? bcrypt($data['password']) : $user->password
    ]);

    if(isset($data['activities'])){

        foreach ( $data['activities'] as $item){

            $test = AssociateActivity::where('associate_id',$company->id)->where('sub_class_economic_activities_id',$item['name'])->first();

            if($test==null){

            
                AssociateActivity::create([
                    'associate_id'=>$company->id,
                    'sub_class_economic_activities_id'=>$item['name']
                ]);
            }

            
        }
}



}


public function destroy($id){
    $user = User::find($id);
    $company = Associate::find($user->company_id);

   
    $user->delete();
    $company->delete();

    return response()->noContent();
}

public function destroyactivity($id){
    $associateactivity = AssociateActivity::find($id);
    $company = Associate::find($associateactivity->associate_id);

    if($company->activity->count() >1){
        $associateactivity->delete();
        return response()->noContent();
    }else{
        abort(402,'Não permitido a exclusão de todas atividades do associado');
    }
    // $company->delete();
}


}
