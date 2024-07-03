<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/home');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');
//đầu tư
Route::get('/invest', [HomeController::class, 'invest'])->name('invest');
Route::post('/invest', [ProductController::class, 'investPost'])->name('invest')->middleware('auth');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/profile', [ProfileController::class, 'index'])->name('profile')->middleware('auth');
Route::get('/desposit', [HomeController::class, 'desposit'])->name('desposit')->middleware('auth');
Route::get('/withdraw', [HomeController::class, 'withdraw'])->name('withdraw')->middleware('auth');
//withdraw-post
Route::post('/withdraw-post', [ProfileController::class, 'withdrawPost'])->name('withdraw-post')->middleware('auth');
// Route::get('/profile/:id', [ProfileController::class, 'index'])->name('profile')
// product detail
Route::get('/product/{slug}', [ProductController::class, 'detail'])->name('product-detail');
// financial
Route::get('/financial', [ProfileController::class, 'financial'])->name('financial')->middleware('auth');
// invest
Route::get('/invest-history', [ProfileController::class, 'investHisttory'])->name('invest-history')->middleware('auth');
// income
Route::get('/income', [ProfileController::class, 'income'])->name('income')->middleware('auth');
// withdraw history
Route::get('/withdraw-history', [ProfileController::class, 'withdrawHistory'])->name('withdraw-history')->middleware('auth');
// deposit history
Route::get('/deposit-history', [ProfileController::class, 'depositHistory'])->name('deposit-history')->middleware('auth');
//setting
Route::get('/setting', [ProfileController::class, 'setting'])->name('setting')->middleware('auth');
Route::get('/setting-bank', [ProfileController::class, 'settingBank'])->name('setting-bank')->middleware('auth');
Route::get('/add-bank', [ProfileController::class, 'addBank'])->name('add-bank')->middleware('auth');
Route::post('/add-bank-post', [ProfileController::class, 'addBankPost'])->name('add-bank-post')->middleware('auth');

//change-password
Route::get('/change-password', [ProfileController::class, 'changePassword'])->name('change-password')->middleware('auth');
Route::post('/change-password', [ProfileController::class, 'changePasswordPost'])->name('change-password-post')->middleware('auth');
Route::get('/change-password2', [ProfileController::class, 'changePassword2'])->name('change-password2')->middleware('auth');
Route::post('/change-password2', [ProfileController::class, 'changePassword2Post'])->name('change-password2-post')->middleware('auth');

//login
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginPost'])->name('login');

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerPost'])->name('register');
//logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route::get('/forgot-password', [AuthController::class, 'forgotPassword'])->name('forgot-password');
