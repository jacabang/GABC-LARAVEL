<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\EmployeeController;

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

Route::get('/', [BranchController::class,'index']);

Route::resource('/branch', BranchController::class, [
    'except' => [ 'show' ]
]);
Route::post('/fetchBranch', [BranchController::class,'fetchBranch']);
Route::post('/checkBranchCode', [BranchController::class,'checkBranchCode']);

Route::resource('/employee', EmployeeController::class, [
    'except' => [ 'show' ]
]);
Route::post('/fetchEmployee', [EmployeeController::class,'fetchEmployee']);
Route::post('/fetchEmployeeSourceViaSearch', [EmployeeController::class,'fetchEmployeeSourceViaSearch']);
