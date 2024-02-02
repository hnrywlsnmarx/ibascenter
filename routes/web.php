<?php

use App\Http\Controllers\ApplicantControllerLastStep;
use App\Http\Controllers\ApplicantControllerStepOne;
use App\Http\Controllers\ApplicantControllerStepUpload;
use App\Http\Controllers\ApplicantControllerStepFive;
use App\Http\Controllers\ApplicantControllerStepFour;
use App\Http\Controllers\ApplicantControllerStepThree;
use App\Http\Controllers\ApplicantControllerStepTwo;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogonController;
use App\Http\Controllers\CalculatePosibility;
use App\Http\Controllers\DataBalancingArgasunyaController;
use App\Http\Controllers\DataBalancingController;
use App\Http\Controllers\DPTController;
use App\Http\Controllers\IbasController;
use App\Http\Controllers\KTAController;
use App\Http\Controllers\QuickCountController;
use App\Http\Controllers\SimulasiController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes(['verify' => true]);
Route::post('login', [App\Http\Controllers\Auth\LogonController::class, 'login'])->name('login');
Route::post('/logouts', [App\Http\Controllers\Auth\LogonController::class, 'logouts'])->name('logouts');
Route::get('/', [LogonController::class, 'index'])->name('index');
Route::post('actionLogin', [LogonController::class, 'actionLogin'])->name('actionLogin');
// Route::get('/home', [LogonController::class, 'startLogin'])->name('startLogin');

Route::get('/kta', [KTAController::class, 'index']);
// Route::get('/', [LogonController::class, 'index']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('logon', LogonController::class);
Route::resource('users', UserController::class);
Route::resource('ibas', IbasController::class);
Route::resource('quick', QuickCountController::class);
Route::resource('dpt', DPTController::class);
Route::resource('calculate', CalculatePosibility::class);
Route::resource('balancing-kalijaga', DataBalancingController::class);
Route::resource('balancing-argasunya', DataBalancingArgasunyaController::class);
Route::resource('registrasi', RegisterController::class);
Route::resource('simulasi', SimulasiController::class);
Route::resource('stepone', ApplicantControllerStepOne::class);
Route::resource('steptwo', ApplicantControllerStepTwo::class);
Route::resource('stepthree', ApplicantControllerStepThree::class);
Route::resource('stepfour', ApplicantControllerStepFour::class);
Route::resource('stepfive', ApplicantControllerStepFive::class);
Route::resource('stepupload', ApplicantControllerStepUpload::class);
Route::resource('laststep', ApplicantControllerLastStep::class);
Route::get('/topdf',[ApplicantControllerLastStep::class, 'toPDF']);
Route::get('/tocheck',[ApplicantControllerLastStep::class, 'toCheck']);
Route::get('/selectrefno',[ApplicantControllerLastStep::class, 'selectRefNo']);
Route::post('getrefno',[ApplicantControllerLastStep::class, 'getByRefNo'])->name('getrefno');
Route::post('getpdf',[ApplicantControllerLastStep::class, 'toPDF'])->name('getpdf');
Route::post('storesupp',[ApplicantControllerStepUpload::class, 'storesupp'])->name('storesupp');
Route::put('updatesupp',[ApplicantControllerStepUpload::class, 'updatesupp'])->name('updatesupp');
Route::get('get-datanik/{id}/{token}', [RegisterController::class, 'getDataNIK']);
Route::get('/reload-captcha', [App\Http\Controllers\Auth\LogonController::class, 'reloadCaptcha']);
Route::get('bunga-search', [SimulasiController::class, 'bungaSearch']);
Route::get('get-datajangka/{id}', [SimulasiController::class, 'getDataJangka']);
Route::get('get-databunga/{prdkkta}/{jgkwkt}', [SimulasiController::class, 'getDataBunga']);
Route::get('findJangkaWaktu', [SimulasiController::class, 'findJangkaWaktu']);
Route::get('role-search', [UserController::class, 'roleSearch']);
Route::get('status-search', [UserController::class, 'statusSearch']);
Route::get('tps-search/{desa}', [QuickCountController::class, 'tpsSearch'])->name('tps-search');
Route::post('notps', [QuickCountController::class, 'getTps'])->name('getTps');
Route::get('saksi-search', [QuickCountController::class, 'saksiSearch']);

