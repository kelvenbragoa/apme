<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApplicationController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/global-provinces', [App\Http\Controllers\GlobalController::class, 'province']);
Route::get('/global-create-quote', [App\Http\Controllers\GlobalController::class, 'createquote']);
Route::get('/activities', [App\Http\Controllers\GlobalController::class, 'activity']);
Route::post('/activities', [App\Http\Controllers\GlobalController::class, 'storeactivity']);
Route::get('/getactivities', [App\Http\Controllers\GlobalController::class, 'getactivities']);



Route::group(['middleware'=>['auth','admin']], function(){

    //Admins Route
    //rotas para CRUD Administradores
    Route::get('/admins/dashboard/allcount', [App\Http\Controllers\Admin\DashboardController::class, 'allcount']);
    Route::get('/admins/dashboard/admincount', [App\Http\Controllers\Admin\DashboardController::class, 'admincount']);
    Route::get('/admins/dashboard/managercount', [App\Http\Controllers\Admin\DashboardController::class, 'managercount']);
    Route::get('/admins/dashboard/associatecount', [App\Http\Controllers\Admin\DashboardController::class, 'associatecount']);
    Route::get('/admins/dashboard/usercount', [App\Http\Controllers\Admin\DashboardController::class, 'usercount']);
    Route::get('/admins/dashboard/expensecount', [App\Http\Controllers\Admin\DashboardController::class, 'expensecount']);
    Route::get('/admins/dashboard/quotecount', [App\Http\Controllers\Admin\DashboardController::class, 'quotecount']);
    Route::get('/admins', [App\Http\Controllers\Admin\AdminsController::class, 'index']);
    Route::post('/admins', [App\Http\Controllers\Admin\AdminsController::class, 'store']);
    Route::delete('/admins/{id}', [App\Http\Controllers\Admin\AdminsController::class, 'destroy']);
    Route::patch('/admins', [App\Http\Controllers\Admin\AdminsController::class, 'update']);
    Route::get('/admins/{id}', [App\Http\Controllers\Admin\AdminsController::class, 'show']);
    Route::get('/admins/{id}/edit', [App\Http\Controllers\Admin\AdminsController::class, 'edit']);
    // Route::get('/admin/search', [App\Http\Controllers\Admin\AdminsController::class, 'search']);

    //rotas para CRUD Gestores
    Route::get('/managers', [App\Http\Controllers\Admin\ManagersController::class, 'index']);
    Route::post('/managers', [App\Http\Controllers\Admin\ManagersController::class, 'store']);
    Route::delete('/managers/{id}', [App\Http\Controllers\Admin\ManagersController::class, 'destroy']);
    Route::patch('/managers', [App\Http\Controllers\Admin\ManagersController::class, 'update']);
    Route::get('/managers/{id}', [App\Http\Controllers\Admin\ManagersController::class, 'show']);
    Route::get('/managers/{id}/edit', [App\Http\Controllers\Admin\ManagersController::class, 'edit']);

    //rotas para CRUD Associados
    Route::get('/associates', [App\Http\Controllers\Admin\AssociatesController::class, 'index']);
    Route::post('/associates', [App\Http\Controllers\Admin\AssociatesController::class, 'store']);
    Route::delete('/associates/{id}', [App\Http\Controllers\Admin\AssociatesController::class, 'destroy']);
    Route::patch('/associates', [App\Http\Controllers\Admin\AssociatesController::class, 'update']);
    Route::get('/associates/{id}', [App\Http\Controllers\Admin\AssociatesController::class, 'show']);
    Route::get('/associates/{id}/edit', [App\Http\Controllers\Admin\AssociatesController::class, 'edit']);
    Route::delete('/activity-associates/{id}', [App\Http\Controllers\Admin\AssociatesController::class, 'destroyactivity']);

  

    //rotas para CRUD Expenses
    Route::get('/expenses', [App\Http\Controllers\Admin\ExpensesController::class, 'index']);
    Route::post('/expenses', [App\Http\Controllers\Admin\ExpensesController::class, 'store']);
    Route::delete('/expenses/{id}', [App\Http\Controllers\Admin\ExpensesController::class, 'destroy']);
    Route::patch('/expenses', [App\Http\Controllers\Admin\ExpensesController::class, 'update']);
    Route::get('/expenses/{id}', [App\Http\Controllers\Admin\ExpensesController::class, 'show']);
    Route::get('/expenses/{id}/edit', [App\Http\Controllers\Admin\ExpensesController::class, 'edit']);


     //rotas para CRUD Events
     Route::get('/events', [App\Http\Controllers\Admin\EventsController::class, 'index']);
     Route::post('/events', [App\Http\Controllers\Admin\EventsController::class, 'store']);
     Route::delete('/events/{id}', [App\Http\Controllers\Admin\EventsController::class, 'destroy']);
     Route::patch('/events', [App\Http\Controllers\Admin\EventsController::class, 'update']);
     Route::get('/events/{id}', [App\Http\Controllers\Admin\EventsController::class, 'show']);
     Route::get('/events/{id}/edit', [App\Http\Controllers\Admin\EventsController::class, 'edit']);


     //rotas para CRUD calendar
     Route::get('/calendars', [App\Http\Controllers\Admin\CalendarsController::class, 'index']);


     //rotas para CRUD notifications
     Route::get('/notifications', [App\Http\Controllers\Admin\NotificationController::class, 'index']);

     //rotas para CRUD configurations
     Route::get('/configurations', [App\Http\Controllers\Admin\ConfigurationController::class, 'index']);
     Route::post('/changepassword', [App\Http\Controllers\Admin\ConfigurationController::class, 'changepassword']);


    //rotas para CRUD Quotes
     Route::get('/quotes', [App\Http\Controllers\Admin\QuotesController::class, 'index']);
     Route::post('/quotes', [App\Http\Controllers\Admin\QuotesController::class, 'store']);
     Route::delete('/quotes/{id}', [App\Http\Controllers\Admin\QuotesController::class, 'destroy']);
     Route::patch('/quotes', [App\Http\Controllers\Admin\QuotesController::class, 'update']);
     Route::get('/quotes/{id}', [App\Http\Controllers\Admin\QuotesController::class, 'show']);
     Route::get('/quotes/{id}/edit', [App\Http\Controllers\Admin\QuotesController::class, 'edit']);

     Route::get('/admin/company/{id}/info', [App\Http\Controllers\Admin\QuotesController::class, 'getCompanyInfo']);



});



Route::group(['middleware'=>['auth','manager']], function(){

    //Admins Route
    //rotas para CRUD Administradores
    Route::get('/manager/dashboard/allcount', [App\Http\Controllers\Manager\DashboardController::class, 'allcount']);
    Route::get('/manager/dashboard/admincount', [App\Http\Controllers\Manager\DashboardController::class, 'admincount']);
    Route::get('/manager/dashboard/managercount', [App\Http\Controllers\Manager\DashboardController::class, 'managercount']);
    Route::get('/manager/dashboard/associatecount', [App\Http\Controllers\Manager\DashboardController::class, 'associatecount']);
    Route::get('/manager/dashboard/usercount', [App\Http\Controllers\Manager\DashboardController::class, 'usercount']);
    Route::get('/manager/dashboard/expensecount', [App\Http\Controllers\Manager\DashboardController::class, 'expensecount']);
    Route::get('/manager/dashboard/quotecount', [App\Http\Controllers\Manager\DashboardController::class, 'quotecount']);
    

    //rotas para CRUD Gestores
    Route::get('/manager-managers', [App\Http\Controllers\Manager\ManagersController::class, 'index']);
    Route::post('/manager-managers', [App\Http\Controllers\Manager\ManagersController::class, 'store']);
    Route::delete('/manager-managers/{id}', [App\Http\Controllers\Manager\ManagersController::class, 'destroy']);
    Route::patch('/manager-managers', [App\Http\Controllers\Manager\ManagersController::class, 'update']);
    Route::get('/manager-managers/{id}', [App\Http\Controllers\Manager\ManagersController::class, 'show']);
    Route::get('/manager-managers/{id}/edit', [App\Http\Controllers\Manager\ManagersController::class, 'edit']);

    //rotas para CRUD Associados
    Route::get('/manager-associates', [App\Http\Controllers\Manager\AssociatesController::class, 'index']);
    Route::post('/manager-associates', [App\Http\Controllers\Manager\AssociatesController::class, 'store']);
    Route::delete('/manager-associates/{id}', [App\Http\Controllers\Manager\AssociatesController::class, 'destroy']);
    Route::patch('/manager-associates', [App\Http\Controllers\Manager\AssociatesController::class, 'update']);
    Route::get('/manager-associates/{id}', [App\Http\Controllers\Manager\AssociatesController::class, 'show']);
    Route::get('/manager-associates/{id}/edit', [App\Http\Controllers\Manager\AssociatesController::class, 'edit']);
    Route::delete('/manager-activity-associates/{id}', [App\Http\Controllers\Manager\AssociatesController::class, 'destroyactivity']);

  

    //rotas para CRUD Expenses
    Route::get('/manager-expenses', [App\Http\Controllers\Manager\ExpensesController::class, 'index']);
    Route::post('/manager-expenses', [App\Http\Controllers\Manager\ExpensesController::class, 'store']);
    Route::delete('/manager-expenses/{id}', [App\Http\Controllers\Manager\ExpensesController::class, 'destroy']);
    Route::patch('/manager-expenses', [App\Http\Controllers\Manager\ExpensesController::class, 'update']);
    Route::get('/manager-expenses/{id}', [App\Http\Controllers\Manager\ExpensesController::class, 'show']);
    Route::get('/manager-expenses/{id}/edit', [App\Http\Controllers\Manager\ExpensesController::class, 'edit']);


     //rotas para CRUD Events
     Route::get('/manager-events', [App\Http\Controllers\Manager\EventsController::class, 'index']);
     Route::post('/manager-events', [App\Http\Controllers\Manager\EventsController::class, 'store']);
     Route::delete('/manager-events/{id}', [App\Http\Controllers\Manager\EventsController::class, 'destroy']);
     Route::patch('/manager-events', [App\Http\Controllers\Manager\EventsController::class, 'update']);
     Route::get('/manager-events/{id}', [App\Http\Controllers\Manager\EventsController::class, 'show']);
     Route::get('/manager-events/{id}/edit', [App\Http\Controllers\Manager\EventsController::class, 'edit']);


     //rotas para CRUD calendar
     Route::get('/manager-calendars', [App\Http\Controllers\Manager\CalendarsController::class, 'index']);


     //rotas para CRUD notifications
     Route::get('/manager-notifications', [App\Http\Controllers\Manager\NotificationController::class, 'index']);

     //rotas para CRUD configurations
     Route::get('/manager-configurations', [App\Http\Controllers\Manager\ConfigurationController::class, 'index']);
     Route::post('/manager-changepassword', [App\Http\Controllers\Manager\ConfigurationController::class, 'changepassword']);


    //rotas para CRUD Quotes
     Route::get('/manager-quotes', [App\Http\Controllers\Manager\QuotesController::class, 'index']);
     Route::post('/manager-quotes', [App\Http\Controllers\Manager\QuotesController::class, 'store']);
     Route::delete('/manager-quotes/{id}', [App\Http\Controllers\Manager\QuotesController::class, 'destroy']);
     Route::patch('/manager-quotes', [App\Http\Controllers\Manager\QuotesController::class, 'update']);
     Route::get('/manager-quotes/{id}', [App\Http\Controllers\Manager\QuotesController::class, 'show']);
     Route::get('/manager-quotes/{id}/edit', [App\Http\Controllers\Manager\QuotesController::class, 'edit']);

     Route::get('/manager/company/{id}/info', [App\Http\Controllers\Manager\QuotesController::class, 'getCompanyInfo']);

     



});

Route::group(['middleware'=>['auth','associate']], function(){

        Route::get('/associate/dashboard/index', [App\Http\Controllers\Associate\DashboardController::class, 'index']);

         //rotas para CRUD Events
         Route::get('/associate-events', [App\Http\Controllers\Associate\EventsController::class, 'index']);
         Route::get('/associate-events/{id}', [App\Http\Controllers\Associate\EventsController::class, 'show']);
    
    
         //rotas para CRUD calendar
         Route::get('/associate-calendars', [App\Http\Controllers\Associate\CalendarsController::class, 'index']);
    
    
         //rotas para CRUD notifications
         Route::get('/associate-notifications', [App\Http\Controllers\Associate\NotificationController::class, 'index']);
    
         //rotas para CRUD configurations
         Route::get('/associate-configurations', [App\Http\Controllers\Associate\ConfigurationController::class, 'index']);
         Route::post('/associate-changepassword', [App\Http\Controllers\Associate\ConfigurationController::class, 'changepassword']);

        Route::get('/associate-associates', [App\Http\Controllers\Associate\AssociatesController::class, 'index']);
        Route::post('/associate-associates', [App\Http\Controllers\Associate\AssociatesController::class, 'store']);
        Route::delete('/associate-associates/{id}', [App\Http\Controllers\Associate\AssociatesController::class, 'destroy']);
        Route::patch('/associate-associates', [App\Http\Controllers\Associate\AssociatesController::class, 'update']);
        Route::get('/associate-associates/{id}', [App\Http\Controllers\Associate\AssociatesController::class, 'show']);
        Route::get('/associate-associates/edit', [App\Http\Controllers\Associate\AssociatesController::class, 'edit']);
        Route::delete('/associate-activity-associates/{id}', [App\Http\Controllers\Associate\AssociatesController::class, 'destroyactivity']);

        
        //rotas para CRUD Quotes
        Route::get('/associate-quotes', [App\Http\Controllers\Associate\QuotesController::class, 'index']);
        Route::post('/associate-quotes', [App\Http\Controllers\Associate\QuotesController::class, 'store']);
        Route::delete('/associate-quotes/{id}', [App\Http\Controllers\Associate\QuotesController::class, 'destroy']);
        Route::patch('/associate-quotes', [App\Http\Controllers\Associate\QuotesController::class, 'update']);
        Route::get('/associate-quotes/{id}', [App\Http\Controllers\Associate\QuotesController::class, 'show']);
        Route::get('/associate-quotes/{id}/edit', [App\Http\Controllers\Associate\QuotesController::class, 'edit']);
    

});




//Ultima rota

Route::get('{view}', ApplicationController::class)->where('view','(.*)')->middleware('auth');




