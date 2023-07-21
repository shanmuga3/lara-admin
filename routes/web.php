<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{ HomeController,
    UserController,
    RoleController,
};

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

Route::group(['middleware' => 'guest'], function () {
    Route::get('login', [HomeController::class,'index'])->name('login');
    Route::post('authenticate', [HomeController::class,'authenticate'])->name('authenticate');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('logout', [HomeController::class,'logout'])->name('logout');
    Route::get('/', function() {
        return redirect()->route('dashboard');
    })->name('home');

    Route::match(['GET','POST'],'dashboard', [HomeController::class,'dashboard'])->name('dashboard');

    // Manage Users Routes
    Route::group(['prefix' => 'users'], function () {
        Route::get('/', [UserController::class,'index'])->name('users')->middleware('permission:read-users');
        Route::get('create', [UserController::class,'create'])->name('users.create')->middleware('permission:create-users');
        Route::post('/', [UserController::class,'store'])->name('users.store')->middleware('permission:create-users');
        Route::get('{id}/edit', [UserController::class,'edit'])->name('users.edit')->middleware('permission:update-users');
        Route::match(['PUT','PATCH'],'{id}', [UserController::class,'update'])->name('users.update')->middleware('permission:update-users');
        Route::delete('{id}', [UserController::class,'destroy'])->name('users.delete')->middleware('permission:delete-users');
    });

    // Manage Roles and Permissions Routes
    Route::group(['prefix' => 'roles'], function () {
        Route::get('/', [RoleController::class,'index'])->name('roles')->middleware('permission:read-roles');
        Route::get('create', [RoleController::class,'create'])->name('roles.create')->middleware('permission:create-roles');
        Route::post('/', [RoleController::class,'store'])->name('roles.store')->middleware('permission:create-roles');
        Route::get('{id}/edit', [RoleController::class,'edit'])->name('roles.edit')->middleware('permission:update-roles');
        Route::match(['PUT','PATCH'],'{id}', [RoleController::class,'update'])->name('roles.update')->middleware('permission:update-roles');
        Route::delete('{id}', [RoleController::class,'destroy'])->name('roles.delete')->middleware('permission:delete-roles');
    });

    Route::get('small-box',function() {
        $data = [
            'main_title' => "Small Box",
            'sub_title' => "Small Box",
        ];
        return view('widgets.small_box',$data);
    })->name('small_box');

    Route::get('info-box',function() {
        $data = [
            'main_title' => "Info Box",
            'sub_title' => "Info Box",
        ];
        return view('widgets.info_box',$data);
    })->name('info_box');

    Route::get('card',function() {
        $data = [
            'main_title' => "Cards",
            'sub_title' => "Cards",
        ];
        return view('widgets.card',$data);
    })->name('card');

});
