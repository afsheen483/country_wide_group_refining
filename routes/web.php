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

Route::resource('roles', 'RoleController');

Route::resource('permissions', 'PermissionController');

// user management
Route::get('/permission_edit/{id}', 'PermissionController@edit')->middleware('auth');
Route::get('/roles_edit/{id}', 'RoleController@edit')->middleware('auth');
Route::get('/users_edit/{id}', 'UserController@edit');
Route::get('dashboard', 'AdminController@index')->middleware('auth');



// Route for check email
Route::post('user/checkemail', 'UserController@userEmailCheck');
Route::post('edit/checkemail', 'UserController@editEmailCheck');


//Item management 
// Route::get('/items', [ItemController::class, 'index'])->name('items');
Route::get('/itemdata','ItemController@index')->name('itemdata')->middleware("auth");
Route::get('/itemdata/getdata','ItemController@getdata')->name('itemdata.getdata')->middleware("auth");

Route::get('/create_item', function () {
    return view('Items.create');
})->name('create_item');

Route::post('/create_item', [ItemController::class, 'store']);

Route::get('/item_edit/{id}', [ItemController::class, 'edit']);
Route::get('/view_item/{id}', [ItemController::class, 'show']);
Route::put('/item_update/{id}','ItemController@update');

Route::get('/item_delete/{id}', [ItemController::class, 'destroy']);

// datatables
Route::get('ajaxdata', 'UserController@index')->name('ajaxdata')->middleware('auth');
Route::get('ajaxdata/getdata', 'UserController@getdata')->name('ajaxdata.getdata')->middleware('auth');