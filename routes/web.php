<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CreditController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SellController;

Route::get('/', function () {
    // return view('welcome');
    return view('Auth/login');
});

// Route::get('/', function () {
//     return view('dashboard');
// });

// Register
// Route::get('register',[AuthController::class,"register"])->name("register");
Route::match(['get','post'],"register",[AuthController::class,"register"])->name("register");

// login
Route::get('login',[AuthController::class,"login"])->name("login");
Route::match(['get','post'],"login",[AuthController::class,"login"])->name("login");

// dashboard
Route::get('dashboard',[AuthController::class,"dashboard"])->name("dashboard");

// Profile
Route::get('profile',[AuthController::class,"profile"])->name("profile");
Route::match(['get','post'],"profile",[AuthController::class,"profile"])->name("profile");


// Profile
Route::get('logout',[AuthController::class,"logout"])->name("logout");

// Protected route (dashboard)
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


    Route::get('ShowItems',[ItemController::class,"ShowItems"])->name("ShowItems");
    Route::get('ShowCredit',[ItemController::class,"ShowCredit"])->name("ShowCredit");
    Route::get('ShowExpense',[ItemController::class,"ShowExpense"])->name("ShowExpense");
    Route::get('ShowSell',[ItemController::class,"ShowSell"])->name("ShowSell");


    //  Routes for Item component
    Route::post('/save-item', [ItemController::class, 'saveItem'])->name('SaveItem');
    Route::get('/edit-items/{id}', [ItemController::class, 'editItem'])->name('edit-item');
    Route::get('/items/{id}/edit', [ItemController::class, 'edit']);
    Route::post('/UpdateItems/{id}', [ItemController::class, 'UpdateItems'])->name('UpdateItems');

    // Routes for Customer component
    Route::get('ShowCustomers',[CustomerController::class,"ShowCustomers"])->name("ShowCustomers");;
    Route::get('edit-customer', [CustomerController::class, 'edit_customer'])->name('edit_customer');
    Route::post('/SaveCustomer', [CustomerController::class, 'SaveCustomer'])->name('SaveCustomer');
     Route::post('/UpdateCustomer/{id}', [CustomerController::class, 'UpdateCustomer'])->name('UpdateCustomer');

    // Route::resource('customer' ,[CustomerController::class])->name('customer');
    // Routes for  Credit Component
    Route::get('ShowCredit',[CreditController::class,"ShowCredit"])->name("ShowCredit");;
    Route::get('/Credit/edit-Credit', [CreditController::class, 'edit2'])->name('edit2');
    Route::post('/save-Credit', [CreditController::class, 'SaveCredit'])->name('SaveCredit');
    Route::post('/UpdateCredit/{id}', [CreditController::class, 'UpdateCredit'])->name('UpdateCredit');


    // Routes for  Expense Component
    Route::get('ShowExpense',[CustomerController::class,"ShowExpense"])->name("ShowExpense");;
    Route::get('/Expense/edit-Expense', [ExpenseController::class, 'edit2'])->name('edit2');
    Route::post('/save-Expense', [ExpenseController::class, 'SaveExpense'])->name('SaveExpense');
    Route::post('/UpdateExpense/{id}', [ExpenseController::class, 'UpdateExpense'])->name('UpdateExpense');


    // Routes for Sell component
    Route::resource('sells', SellController::class);

    // Route::get('ShowSell',[CustomerController::class,"ShowSell"])->name("ShowSell");;
    // Route::get('/sell/edit-sell', [sellController::class, 'edit2'])->name('edit2');
    // Route::post('/save-sell', [sellController::class, 'Savesell'])->name('Savesell');
    // Route::post('/Updatesell/{id}', [sellController::class, 'Updatesell'])->name('Updatesell');


     // Routes for Sell component
     Route::get('Showreport',[CustomerController::class,"Showreport"])->name("Showreport");;
     Route::get('/report/edit-report', [reportController::class, 'edit2'])->name('edit2');
     Route::post('/save-report', [reportController::class, 'Savereport'])->name('Savereport');
     Route::post('/Updatereport/{id}', [reportController::class, 'Updatereport'])->name('Updatereport');

});




