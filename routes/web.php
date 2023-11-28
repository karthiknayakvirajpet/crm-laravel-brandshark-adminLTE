<?php

use Illuminate\Support\Facades\Route;

/*
=> AdminLTE:
https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Installation
https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Usage
https://chat.openai.com/c/8857bba3-c4af-4052-a04e-a0953e9be564
https://adminlte.io/themes/v3/pages/forms/general.html
=========== CHANGE DESIGN OF TEMPLATE IN - config/adminlte.php

=> Auth Vue:
https://laravelarticle.com/laravel-8-authentication-tutorial
https://stackoverflow.com/questions/73048645/npm-run-dev-not-working-with-vite-laravel-9
https://chat.openai.com/c/ee62b170-8f36-426d-b206-5f8d2136faad
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function () 
{
    //HomeController routes-----------------------------------------------------
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    //--------------------------------------------------------------------------

    //CompanyController routes--------------------------------------------------
    Route::resource('company', App\Http\Controllers\CompanyController::class);
    Route::get('edit-company/{id}', 'App\Http\Controllers\CompanyController@edit')->name('company.edit');
    Route::get('delete-company/{id}', 'App\Http\Controllers\CompanyController@destroy')->name('company.destroy');
    //--------------------------------------------------------------------------

    //EmployeeController routes-------------------------------------------------
    Route::resource('employee', App\Http\Controllers\EmployeeController::class);
    Route::get('edit-employee/{id}', 'App\Http\Controllers\EmployeeController@edit')->name('employee.edit');
    Route::get('delete-employee/{id}', 'App\Http\Controllers\EmployeeController@destroy')->name('employee.destroy');
    //--------------------------------------------------------------------------
});