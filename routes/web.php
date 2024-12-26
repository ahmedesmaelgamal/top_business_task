<?php

use Illuminate\Support\Facades\Route;

Route::controller(\App\Http\Controllers\Dashboard\EmployeeController::class)->group(function (){
Route::get('/','index')->name('employee.index');
    Route::get('/employee/{id}','show')->name('employee.show');

});
