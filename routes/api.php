<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::controller(\App\Http\Controllers\API\EmployeeApiController::class)->group(function (){
Route::get('/employee','index');
    Route::get('/employee/{id}','show');
});
