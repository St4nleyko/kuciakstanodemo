<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;

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

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/roles', [RoleController::class,'index'])->name('role');
Route::get('/home', [HomeController::class,'index'])->name('home');

Route::group(['middleware' => ['role:superAdmin']], function () {
//roles
Route::get('/addrole', [RoleController::class,'addRole'])->name('add.role');
Route::post('/storerole', [RoleController::class,'storeRole'])->name('store.role');
Route::get('/editrole/{id}', [RoleController::class,'editRole'])->name('edit.role');
Route::post('/updaterole/{id}', [RoleController::class,'updateRole'])->name('update.role');
Route::post('/deleterole/{id}', [RoleController::class,'deleteRole'])->name('delete.role');

//users
Route::get('/users', [UserController::class,'indexUser'])->name('index.user');
Route::get('/edituser/{id}', [UserController::class,'editUser'])->name('edit.user');
Route::post('/updateuser/{id}', [UserController::class,'updateUser'])->name('update.user');
Route::post('/deleteuser/{id}', [UserController::class,'deleteUser'])->name('delete.user');
Route::get('/createuser', [UserController::class,'createUser'])->name('create.user');
Route::post('/storeuser', [UserController::class,'storeUser'])->name('store.user');


});
