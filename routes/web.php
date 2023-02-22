<?php

use App\Http\Controllers\BankController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RentController;
use App\Http\Controllers\SamsatController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\MotorController;
use App\Http\Controllers\MonitoringController;
use App\Models\RentLogs;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Customer
Route::get('customer-profile', [ProfileController::class, 'indexcus'])->name('customer-profile');
Route::post('customer-profile', [ProfileController::class, 'updatecus'])->name('save-customer-profile');
Route::post('change-passwordcus', [ProfileController::class, 'updatepasswordcus'])->name('change-passwordcus');

Route::get('/', [PublicController::class, 'index'])->name('pub-index');
Route::get('/cart', [PublicController::class, 'dashboard'])->name('cus-dashboard');
Route::get('/cartmotor', [PublicController::class, 'dashboardmotor'])->name('cusmotor-dashboard');
Route::get('cart/{id}/print', [PublicController::class, 'printInvoice'])->name('cart.print');
Route::get('/detail/{slug}', [PublicController::class, 'detail'])->name('detail');
Route::get('/detailmotor/{slug}', [PublicController::class, 'detailmotor'])->name('detailmotor');
Route::post('/detail/{slug}', [PublicController::class, 'rentCustomer'])->name('rentCustomer-add');
Route::post('/detailmotor/{slug}', [PublicController::class, 'rentCustomermotor'])->name('rentCustomermotor-add');

Route::get('/sign-in', function () {return redirect('sign-in');});
Route::post('sign-out', [SessionsController::class, 'destroy'])->name('logout');
Route::get('/car/{id}/update-status-and-create-samsat', [CarController::class, 'updateStatusAndCreateSamsat'])->name('car.update-status-and-create-samsat');
Route::get('/motor/{id}/update-status-and-create-samsat', [MotorController::class, 'updateStatusAndCreateSamsat'])->name('motor.update-status-and-create-samsat');


Route::middleware('guest')->group(function(){
	//Register
	Route::get('sign-up', [RegisterController::class, 'create'])->name('register');
	Route::post('sign-up', [RegisterController::class, 'store']);
	//Login
	Route::get('sign-in', [SessionsController::class, 'create'])->name('login');
	Route::post('sign-in', [SessionsController::class, 'store']);
	Route::post('verify', [SessionsController::class, 'show']);
	Route::post('reset-password', [SessionsController::class, 'update'])->name('password.update');
	Route::get('verify', function () {
		return view('sessions.password.verify');
	})->name('verify'); 
	Route::get('/reset-password/{token}', function ($token) {
		return view('sessions.password.reset', ['token' => $token]);
	})->name('password.reset');
});

Route::middleware('auth', 'only_admin')->group(function(){
	Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
	//User
	Route::get('user', [UserController::class, 'index'])->name('user-index');
	Route::get('user-add', [UserController::class, 'create'])->name('user-create');
	Route::post('user-add', [UserController::class, 'store'])->name('user-add');
	Route::get('user-detail/{id}', [UserController::class, 'show'])->name('user-detail');
	Route::get('user-edit/{id}', [UserController::class, 'edit'])->name('user-edit');
	Route::post('user-update/{id}', [UserController::class, 'update'])->name('user-update');
	Route::delete('user-delete/{id}', [UserController::class, 'destroy'])->name('user-delete');
	Route::put('user-status/{id}', [UserController::class, 'updateStatus'])->name('user-updatestatus');
	
	//Logout
	Route::get('user-profile', [ProfileController::class, 'index'])->name('user-profile');
	Route::post('user-profile', [ProfileController::class, 'update'])->name('save-user-profile');
	Route::post('change-password', [ProfileController::class, 'updatepassword'])->name('change-password');
	Route::get('profile', [ProfileController::class, 'create'])->name('profile');

	//Category
	Route::get('category', [CategoryController::class, 'index'])->name('category-index');
	
	Route::get('category-add', [CategoryController::class, 'create'])->name('category-create');
	Route::post('category-add', [CategoryController::class, 'store'])->name('category-add');
	Route::get('category-edit/{slug}', [CategoryController::class, 'edit'])->name('category-edit');
	Route::put('category-update/{slug}', [CategoryController::class, 'update'])->name('category-update');
	Route::delete('category-delete/{slug}', [CategoryController::class, 'destroy'])->name('category-delete');
	//Category Motor
	Route::get('categorymotor', [CategoryController::class, 'motorindex'])->name('categorymotor-index');
	Route::get('categorymotor-add', [CategoryController::class, 'motorcreate'])->name('categorymotor-create');
	Route::post('categorymotor-add', [CategoryController::class, 'storemotor'])->name('categorymotor-add');

	//Vendor
	Route::get('vendors', [VendorController::class, 'index'])->name('vendor-index');
	Route::get('vendor-add', [VendorController::class, 'create'])->name('vendor-create');
	Route::post('vendor-add', [VendorController::class, 'store'])->name('vendor-add');
	Route::get('vendor-edit/{slug}', [VendorController::class, 'edit'])->name('vendor-edit');
	Route::put('vendor-update/{slug}', [VendorController::class, 'update'])->name('vendor-update');
	Route::delete('vendor-delete/{slug}', [VendorController::class, 'destroy'])->name('vendor-delete');
	//Vendor Motor
	Route::get('vendormotor', [VendorController::class, 'motorindex'])->name('vendormotor-index');
	Route::get('vendormotor-add', [VendorController::class, 'motorcreate'])->name('vendormotor-create');
	Route::post('vendormotor-add', [VendorController::class, 'storemotor'])->name('vendormotor-add');

	//Bank
	Route::get('bank', [BankController::class, 'index'])->name('bank-index');
	Route::get('bank-add', [BankController::class, 'create'])->name('bank-create');
	Route::post('bank-add', [BankController::class, 'store'])->name('bank-add');
	Route::get('bank-edit/{id}', [BankController::class, 'edit'])->name('bank-edit');
	Route::put('bank-update/{id}', [BankController::class, 'update'])->name('bank-update');
	Route::delete('bank-delete/{id}', [BankController::class, 'destroy'])->name('bank-delete');

	//Car
	Route::get('car', [CarController::class, 'index'])->name('car-index');
	Route::get('car-add', [CarController::class, 'create'])->name('car-create');
	Route::get('car-detail/{id}', [CarController::class, 'show'])->name('car-detail');
	Route::post('car-add', [CarController::class, 'store'])->name('car-add');
	Route::get('car-edit/{slug}', [CarController::class, 'edit'])->name('car-edit');
	Route::post('car-edit/{slug}', [CarController::class, 'update'])->name('car-update');
	Route::delete('car-delete/{slug}', [CarController::class, 'destroy'])->name('car-delete');
	
	//Motor
	Route::get('motor', [MotorController::class, 'index'])->name('motor-index');
	Route::get('motor-add', [MotorController::class, 'create'])->name('motor-create');
	Route::get('motor-detail/{id}', [MotorController::class, 'show'])->name('motor-detail');
	Route::post('motor-add', [MotorController::class, 'store'])->name('motor-add');
	Route::get('motor-edit/{slug}', [MotorController::class, 'edit'])->name('motor-edit');
	Route::post('motor-edit/{slug}', [MotorController::class, 'update'])->name('motor-update');
	Route::delete('motor-delete/{slug}', [MotorController::class, 'destroy'])->name('motor-delete');

	//Rent
	Route::get('rent/{id}/print', [RentController::class, 'printInvoice'])->name('rent.print');
	Route::get('/filter-rentcar', [RentController::class, 'filtermobil'])->name('filter-rentcar');
	Route::get('rentcar', [RentController::class, 'index'])->name('rentcar-index');
	Route::get('rentcar-add', [RentController::class, 'create'])->name('rentcar-create');
	Route::post('rentcar-add', [RentController::class, 'store'])->name('rentcar-add');
	Route::get('rent-detail/{id}', [RentController::class, 'show'])->name('rent-detail');
	Route::get('rentcar-return/{id}', [RentController::class, 'returnCar'])->name('rentcar-return');
	Route::post('rentcar-returnupdate/{id}', [RentController::class, 'returnCarupdate'])->name('returncar-update');
	Route::get('rentcar-returnedit/{id}', [RentController::class, 'returnCaredit'])->name('rentcar-return-edit');
	Route::post('rentcar-returneditupdate/{id}', [RentController::class, 'returnCareditUpdate'])->name('rentcar-return-update');
	
	Route::delete('rent-delete/{id}', [RentController::class, 'destroy'])->name('rent-delete');
	Route::put('rent-status/{id}', [RentController::class, 'updateStatus'])->name('rent-updatestatus');

	//Rent Motor
	Route::get('rentmotor', [RentController::class, 'indexmotor'])->name('rentmotor-index');
	Route::get('rentmotor-add', [RentController::class, 'createmotor'])->name('rentmotor-create');
	Route::post('rentmotor-add', [RentController::class, 'storemotor'])->name('rentmotor-add');
	Route::get('rentmotor-detail/{id}', [RentController::class, 'showmotor'])->name('rentmotor-detail');
	Route::get('rentmotor-return/{id}', [RentController::class, 'returnMotor'])->name('rentmotor-return');
	Route::post('rentmotor-returnupdate/{id}', [RentController::class, 'returnMotorupdate'])->name('returnmotor-update');
	Route::get('rentmotor-returnedit/{id}', [RentController::class, 'returnMotoredit'])->name('rentmotor-return-edit');
	Route::post('rentmotor-returneditupdate/{id}', [RentController::class, 'returnMotoreditUpdate'])->name('rentmotor-return-update');
	
	//Samsat Mobil
	Route::get('samsat', [SamsatController::class, 'index'])->name('samsat-index');
	Route::get('samsat-add', [SamsatController::class, 'create'])->name('samsat-create');
	Route::post('samsat-post', [SamsatController::class, 'store'])->name('samsat-add');
	Route::get('samsat-detail/{id}', [SamsatController::class, 'show'])->name('samsat-detail');
	Route::get('samsat-renewedit/{id}', [SamsatController::class, 'editRenew'])->name('samsat-renew-edit');
	Route::post('samsat-renewupdate/{id}', [SamsatController::class, 'updateRenew'])->name('samsat-renew-update');
	Route::delete('samsat-delete/{id}', [SamsatController::class, 'destroy'])->name('samsat-delete');
	// Route::get('samsat-edit/{id}', [SamsatController::class, 'edit'])->name('samsat-edit');
	// Route::post('samsat-edit/{id}', [SamsatController::class, 'update'])->name('samsat-update');

	//Samsat Motor
	Route::get('samsatmotor', [SamsatController::class, 'indexmotor'])->name('samsatmotor-index');
	Route::post('samsatmotor-post', [SamsatController::class, 'storemotor'])->name('samsatmotor-add');
	Route::get('samsatmotor-detail/{id}', [SamsatController::class, 'showmotor'])->name('samsatmotor-detail');
	Route::get('samsatmotor-renewedit/{id}', [SamsatController::class, 'editRenewmotor'])->name('samsatmotor-renew-edit');
	Route::post('samsatmotor-renewupdate/{id}', [SamsatController::class, 'updateRenewmotor'])->name('samsatmotor-renew-update');

	//Monitoring
	Route::get('monitoringcar', [MonitoringController::class, 'index'])->name('monitoringcar-index');
	Route::get('monitoringmotor', [MonitoringController::class, 'indexmotor'])->name('monitoringmotor-index');

});


// Route::group(['middleware' => 'auth'], function () {
// 	Route::get('billing', function () {
// 		return view('pages.billing');
// 	})->name('billing');
// 	Route::get('tables', function () {
// 		return view('pages.tables');
// 	})->name('tables');
// 	Route::get('rtl', function () {
// 		return view('pages.rtl');
// 	})->name('rtl');
// 	Route::get('virtual-reality', function () {
// 		return view('pages.virtual-reality');
// 	})->name('virtual-reality');
// 	Route::get('notifications', function () {
// 		return view('pages.notifications');
// 	})->name('notifications');
// 	Route::get('static-sign-in', function () {
// 		return view('pages.static-sign-in');
// 	})->name('static-sign-in');
// 	Route::get('static-sign-up', function () {
// 		return view('pages.static-sign-up');
// 	})->name('static-sign-up');
	
// });