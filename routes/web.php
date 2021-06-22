<?php

use App\Events\SendPosition;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\TruckController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\MainController;
use Illuminate\Http\Request;


Route::redirect('/', 'login');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

Route::get('/logout', [LogoutController::class, 'index'])->name('logout')->middleware('auth');

//Pagrindinis + pranešimai
Route::get('/pagrindinis', [MainController::class, 'index'])->name('main')->middleware('auth');
Route::get('/pranesimai', [MainController::class, 'notification'])->name('notifications')->middleware('auth');
Route::get('/pranesimaiMark/{id}', [MainController::class, 'notificationMark'])->middleware('auth');

Route::get('markAsRead', function(){
    auth()->user()->unreadNotifications->markAsRead();
    return redirect()->back();
})->name('markRead')->middleware('auth');

//Užsakymai
Route::get('/uzsakymai', [OrderController::class, 'index'])->name('order')->middleware('auth');
Route::get('/uzsakymai/ieskoti-pagal-data', [OrderController::class, 'searchDate'])->name('orderDateSearch')->middleware('auth');
Route::get('/uzsakymai/ieskoti-pagal-uzsakova', [OrderController::class, 'searchCustomer'])->name('orderCustomersSearch')->middleware('auth');
Route::post('/uzsakymai/prideti', [OrderController::class, 'store'])->name('addOrder')->middleware('auth');
Route::post('/uzsakymai/redaguoti/{id}', [OrderController::class, 'update'])->name('editOrder')->middleware('auth');
Route::post('/uzsakymai/salinti/{id}', [OrderController::class, 'destroy'])->name('deleteOrder')->middleware('auth');

// Užsakovai
Route::get('/uzsakovai', [CustomerController::class, 'index'])->name('customer')->middleware('auth');
Route::get('/uzsakovai/ieskoti', [CustomerController::class, 'search'])->name('customersSearch')->middleware('auth');
Route::post('/uzsakovai/prideti', [CustomerController::class, 'store'])->name('addCustomer')->middleware('auth');
Route::post('/uzsakovai/redaguoti/{id}', [CustomerController::class, 'update'])->name('editCustomer')->middleware('auth');
Route::post('/uzsakovai/salinti/{id}', [CustomerController::class, 'destroy'])->name('deleteCustomer')->middleware('auth');

//Vairuotojai
Route::get('/vairuotojai', [DriverController::class, 'index'])->name('driver')->middleware('auth');
Route::get('/vairuotojai/ieskoti', [DriverController::class, 'searchName'])->name('driversSearchName')->middleware('auth');
Route::get('/vairuotojai/ieskotiBusena', [DriverController::class, 'searchState'])->name('driversSearchState')->middleware('auth');
Route::post('/vairuotojai/prideti', [DriverController::class, 'store'])->name('addDriver')->middleware('auth');
Route::post('/vairuotojai/redaguoti/{id}', [DriverController::class, 'update'])->name('editDriver')->middleware('auth');
Route::post('/vairuotojai/salinti/{id}', [DriverController::class, 'destroy'])->name('deleteDriver')->middleware('auth');

//Transporto priemonės
Route::get('/transportoPriemones', [TruckController::class, 'index'])->name('truck')->middleware('auth');
Route::get('/transportoPriemones/ieskoti', [TruckController::class, 'searchTruck'])->name('truckSearch')->middleware('auth');;
Route::post('/transportoPriemones/prideti', [TruckController::class, 'store'])->name('addTruck')->middleware('auth');
Route::post('/transportoPriemones/redaguoti/{id}', [TruckController::class, 'update'])->name('editTruck')->middleware('auth');
Route::post('/transportoPriemones/salinti/{id}', [TruckController::class, 'destroy'])->name('deleteTruck')->middleware('auth');

//Darbuotojai
Route::get('/darbuotojai', [EmployeeController::class, 'index'])->name('employee')->middleware('auth');
Route::get('/darbuotojai/ieskoti', [EmployeeController::class, 'searchName'])->name('employeesSearchName')->middleware('auth');
Route::post('/darbuotojai/prideti', [EmployeeController::class, 'store'])->name('addEmployee')->middleware('auth');
Route::post('/darbuotojai/redaguoti/{id}', [EmployeeController::class, 'update'])->name('editEmployee')->middleware('auth');
Route::post('/darbuotojai/salinti/{id}', [EmployeeController::class, 'destroy'])->name('deleteEmployee')->middleware('auth');
Route::get('/mano-paskyra', [EmployeeController::class, 'myProfile'])->name('profInfo')->middleware('auth');
Route::post('/mano-paskyra/redaguoti', [EmployeeController::class, 'myProfileEdit'])->name('profInfoEdit')->middleware('auth');

//Žemėlapis
Route::get('/zemelapis', [TruckController::class, 'getGPS'])->name('map')->middleware('auth');
Route::get('/zemelapis/gps', [TruckController::class, 'getGPSData'])->middleware('auth');

//Grafikai
Route::get('/grafikai', [ChartController::class, 'PieChart'])->name('charts')->middleware('auth');
Route::get('/grafikai/order', [ChartController::class, 'orderChartSearch'])->name('orderChartSearch')->middleware('auth');
Route::get('/grafikai/payment', [ChartController::class, 'paymentChartSearch'])->name('paymentChartSearch')->middleware('auth');

//PDF
Route::get('/uzsakymoInformacija/{id}', [PDFController::class, 'report'])->name('orderpdf')->middleware('auth');
Route::get('/saskaita/{id}', [PDFController::class, 'payment'])->name('paymentpdf')->middleware('auth');
Route::get('/vaztarastis/{id}', [PDFController::class, 'consignment'])->name('consignmentpdf')->middleware('auth');