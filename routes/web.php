<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\DonateController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserListController;
use App\Models\category;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {



    // Profile Page
    Route::get('adminDashboard',[UserController::class,'index'])->name('admin#Dashboard');
    Route::post('adminProfile/update/{id}',[UserController::class,'updateProfile'])->name('admin#editProfile');
    Route::get('adminProfile/editPassword',[UserController::class,'editPassword'])->name('admin#editPassword');
    Route::post('adminProfile/changePassword/{id}',[UserController::class,'changePassword'])->name('admin#changePassword');


   // User List Page
    Route::get('userList',[UserListController::class,'index'])->name('admin#UserList');
    Route::get('userList/edit/{id}',[UserListController::class,'editUser'])->name('admin#editUser');
    Route::post('userList/update/{id}',[UserListController::class,'updateUser'])->name('admin#updateUser');
    Route::get('userList/delete/{id}',[UserListController::class,'deleteUser'])->name('admin#deleteUser');
    Route::get('userlist/search',[UserListController::class,'searchUser'])->name('admin#searchUser');


   // Category List Page
    Route::get('category',[CategoryController::class,'indexCategory'])->name('admin#category');
    Route::post('category',[CategoryController::class,'createCategory'])->name('admin#createCategory');
    Route::get('category/edit/{id}',[CategoryController::class,'editCategory'])->name('admin#editCategory');
    Route::post('category/update/{id}',[CategoryController::class,'updateCategory'])->name('admin#updateCategory');
    Route::get('category/delete/{id}',[CategoryController::class,'deleteCategory'])->name('admin#deleteCategory');
    Route::get('category/search',[CategoryController::class,'searchCategory'])->name('admin#searchCategory');


   // Income List Page
    Route::get('donate',[DonateController::class,'indexDonate'])->name('admin#indexDonate');
    Route::post('donate/income/{id}',[DonateController::class,'incomeDonate'])->name('admin#incomeDonate');
    Route::get('donate/list',[DonateController::class,'listDonate'])->name('admin#listDonate');
    Route::get('donate/list/search',[DonateController::class,'searchDonate'])->name('admin#searchDonate');
    Route::get('donate/list/edit/{id}',[DonateController::class,'editDonation'])->name('admin#editDonation');
    Route::post('donate/list/update/{id}',[DonateController::class,'updateDonation'])->name('admin#updateDonation');
    Route::get('donate/list/delete/{id}',[DonateController::class,'deleteDonation'])->name('admin#deleteDonation');


   // Expense List Page
    Route::get('expense',[ExpenseController::class,'indexExpense'])->name('admin#indexExpense');
    Route::post('expense/usage/{id}',[ExpenseController::class,'usageExpense'])->name('admin#usageExpense');
    Route::get('expense/list',[ExpenseController::class,'listExpense'])->name('admin#listExpense');
    Route::get('expense/list/search',[ExpenseController::class,'searchExpense'])->name('admin#searchExpense');
    Route::get('expense/lsit/edit/{id}',[ExpenseController::class,'editExpense'])->name('admin#editExpense');
    Route::post('expense/list/update/{id}',[ExpenseController::class,'updateExpense'])->name('admin#updateExpense');
    Route::get('expense/delete/{id}',[ExpenseController::class,'deleteExpense'])->name('admin#deleteExpense');


   // Chart Repost Page
    Route::get('incomeChart',[ChartController::class,'indexIncomeChart'])->name('admin#incomechart');
    Route::get('expenseChart',[ChartController::class,'indexExpenseChart'])->name('admin#expensechart');


});
