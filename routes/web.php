<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
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

// Route::get('/', function () {
//     return view('pages.newlogin');
// });


// dashboard redirection
Route::get('/', function () {
    if (Auth::check()) {
        return view('admin.dashboard');
    }
    return view('pages.newlogin');
})->name('login');

// dashboard route
Route::get('dashboard',function(){
    return view('admin.dasboard');
});


Route::get('/login', function () {
    if (Auth::check()) {
        return view('admin.dashboard');
    }
    return view('pages.newlogin');
})->name('login');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::resource('users', 'UserController')->middleware('auth');

Route::resource('roles', 'RoleController')->middleware('auth');

Route::resource('permissions', 'PermissionController')->middleware('auth');

// user management
Route::get('/permission_edit/{id}', 'PermissionController@edit')->middleware('auth');
Route::get('/roles_edit/{id}', 'RoleController@edit')->middleware('auth');
Route::get('/users_edit/{id}', 'UserController@edit')->middleware('auth');
Route::get('dashboard', 'AdminController@index')->middleware('auth');




// active status
Route::put('/active_status_user/{id}','UserController@StatusUpdate')->middleware('auth');


// Route for check email
Route::post('user/checkemail', 'UserController@userEmailCheck')->middleware('auth');
Route::post('edit/checkemail', 'UserController@editEmailCheck')->middleware('auth');


//Item management 
// Route::get('/items', [ItemController::class, 'index'])->name('items');
Route::get('/itemdata','ItemController@index')->name('itemdata')->middleware("auth");
Route::get('/itemdata/getdata','ItemController@getdata')->name('itemdata.getdata')->middleware("auth");

Route::get('/create_item', function () {
    return view('Items.create');
})->name('create_item');

Route::post('/create_item', [ItemController::class, 'store'])->middleware('auth');

Route::get('/item_edit/{id}', [ItemController::class, 'edit'])->middleware('auth');
Route::get('/view_item/{id}', [ItemController::class, 'show'])->middleware('auth');
Route::put('/item_update/{id}','ItemController@update')->middleware('auth');

Route::put('/item_delete/{id}', [ItemController::class, 'destroy'])->middleware('auth');

// datatables
Route::get('ajaxdata', 'UserController@index')->name('ajaxdata')->middleware('auth');
Route::get('ajaxdata/getdata', 'UserController@getdata')->name('ajaxdata.getdata')->middleware('auth');


// view history inserted
Route::post('view_history','ViewedHistoryController@viewHistory')->middleware("auth");
Route::get('/viewhistory','ViewedHistoryController@index')->name('viewhistory')->middleware("auth");
Route::get('/viewhistory/getData','ViewedHistoryController@getData')->name('viewhistory.getData')->middleware("auth");


// profile
Route::get('/profile','ProfileSettings@profile')->middleware('auth');
Route::get('/change_password',function(){
    return view('ProfileSettings.change_password');
});
Route::put('/change_password','ProfileSettings@ChangePassword')->middleware('auth');

// metal price

Route::get('/metal_price',function(){
    return view('Metals.form');
});
Route::post('/metal_price','MetalController@store')->middleware('auth');



// insert indiviual user price
Route::put('/insert_price','UserItemController@PriceInssert')->middleware('auth');
// update prices on the basis of their percenatges
Route::put('/update_useritem_prices','UserItemController@PriceUpdate')->middleware('auth');


// generate invoices
// Route::get('','InvoiceController@InvoiceGenerate')->middleware('auth');
// Route::get('/invoice_generate',function(){
//     return view('Invoices.index');
// });
// Route::get('invoice_generate/{id}/{vendor_id}','InvoiceController@InvoiceGenerate')->middleware('auth');




Route::post('upload_file','InvoiceController@InsertInvoice')->middleware('auth');

// invoices for items
Route::get('invoice_generate','InvoiceController@GetInvoices')->middleware('auth');
Route::get('invoice_view/{id}','InvoiceController@ViewInvoices')->middleware('auth');


// invoice datatable
Route::get('/invoice','InvoiceController@index')->name('invoice')->middleware("auth");
Route::get('/invoice/getData','InvoiceController@getData')->name('invoice.getData')->middleware("auth");
// signatures save of vendor
Route::put('save_signature','InvoiceController@Signature')->middleware('auth');

// bulk items
Route::post('file-import', [ItemController::class, 'fileImport'])->name('file-import');
Route::get('invoice_slip/{id}','InvoiceController@InvoiceSlip' );

