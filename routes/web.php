<?php

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
//route
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dangky', function () {
    return view('dangky');
});
Route::get('/adduser', 'LoginsController@index');
Route::match(['get', 'post'],'home','LoginsController@login');
Route::get('/phancongkiemke', 'PhanCongKiemKeController@index');
Route::get('/kiemketonghop', 'KiemKeController@index');
Route::get('/kiemkecuahang', 'KiemKeController@indexcuahang');
Route::get('/kiemkenhanvien', 'KiemKeController@indexnhanvien');
Route::get('/chitietmhkh', 'KiemKeController@indexchitietmhkh');

Route::post('editphancong', 'PhanCongKiemKeController@editpckk');
Route::post('deletephancong', 'PhanCongKiemKeController@deletepckk');
Route::post('editnhanvien', 'UsersController@editnv');
Route::post('deletenhanvien', 'UsersController@deletenv');
Route::post('changestatus', 'UsersController@changestatus');
Route::post('kiemkehethong', 'KiemKeController@kiemkehethong');
Route::post('kiemkecuahang', 'KiemKeController@kiemkecuahang');
Route::post('kiemkenhanvien', 'KiemKeController@kiemkenhanvien');
Route::post('kiemkemhkh', 'KiemKeController@kiemkechitietmhkh');


//resource
Route::resource('loginss','LoginsController');
Route::resource('registers','RegistersController');
Route::resource('phancongkiemke','PhanCongKiemKeController');


Auth::routes();