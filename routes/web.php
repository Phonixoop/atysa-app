<?php

use App\Http\Controllers\PayController;
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
use App\Http\Middleware\isAdmin;
use GuzzleHttp\Psr7\Response;

Route::middleware(['auth','web','isUser'])->group(function(){
	Route::get('/','UserController@dashboard');
});
Route::get('/posts', 'PostController@all');

Route::get('/pay', [PayController::class,"zarinpalverify"]);
Route::middleware(['web'])->group(function(){
  
    Route::get('/login', 'AuthController@loginPage')->name('newlogin');
    Route::get('/logout', 'AuthController@logout');
    Route::post('/login', 'AuthController@login');
    Route::post('/resend-activate', 'AuthController@resendActivation');
    Route::post('/activate', 'AuthController@loginWithoutPassword');
    Route::get('/poll', 'UserController@pollPage');
    Route::post('/poll', 'UserController@pollSend');
    Route::get('/admin-login', 'AuthController@adminLogin');
    Route::post('/admin-login', 'AuthController@adminLoginPost');
});
Route::prefix('user')->group(function(){
    Route::middleware(['auth','web','isUser'])->group(function(){
        Route::get('/','UserController@dashboard');
        Route::get('/dashboard','UserController@dashboard');
        Route::get('/create-plate','UserController@createPlate');
        Route::post('/create-plate','UserController@insertPlate');
        Route::post('/deleteplate','UserController@deletePlate');
        Route::get('/all-plates','UserController@allPlates');
        Route::get('/plan','UserController@addPlan');
        Route::post('/plan','UserController@updatePlan');
        Route::post('/take-second-level', 'UserController@takeSecondLevel');
        Route::get('/profile', 'UserController@profile');
        Route::post('/profile', 'UserController@updateProfile');
        Route::get('/calory', 'UserController@editCalory');
        Route::post('/calory', 'UserController@updateEditCalory');
    });
});
Route::prefix('logistic')->group(function(){
    Route::middleware(['isLogistic','web'])->group(function(){
        Route::get('/','Logistic\CompanyController@all');
        Route::post('/companies/hotbox','Logistic\CompanyController@hotboxUpdate');
        Route::get('/companies/report/{id}','Logistic\CompanyController@report');

        Route::get('/profile','Logistic\CompanyController@profile');
        Route::post('/profile','Logistic\CompanyController@profileUpdate');
    });
});    
Route::prefix('sale')->group(function(){
    Route::middleware(['isSales','web'])->group(function(){
    Route::get('/profile','Sales\CompanyController@profile');
    Route::post('/profile','Sales\CompanyController@profileUpdate');

    Route::get('/','Sales\CompanyController@all');
    Route::get('/companies/new','Sales\CompanyController@new');
    Route::get('/companies/single/{id}','Sales\CompanyController@single');
    Route::get('/companies/personels/{id}','Sales\CompanyController@personels');
    Route::get('/companies/sidedish/{id}','Sales\CompanyController@companySidedishes');
    Route::post('/companies/updatesidedishes','Sales\CompanyController@companySidedishesUpdate');
    Route::get('/companies/all','Sales\CompanyController@all');
    Route::post('/companies/delete','Sales\CompanyController@delete');
    Route::post('/companies/create','Sales\CompanyController@create');
    Route::post('/companies/update','Sales\CompanyController@update');
    Route::get('/companies/users/plan/{id}','Sales\CompanyController@userPlan');
    Route::post('/companies/users/updateplan/','Sales\CompanyController@userPlanUpdate');
    Route::get('/companies/users/daily/{id}','Sales\CompanyController@daily');
    Route::get('/companies/login/{id}','Sales\CompanyController@loginAs');
    });
});
Route::prefix('admin')->group(function(){
    Route::middleware(['isAdmin','web'])->group(function(){
        Route::get('/','Admin\UserController@all');
        Route::get('/poll','Admin\UserController@poll');
        Route::get('/exportpoll','Admin\UserController@exportPoll');
        Route::get('/users/new','Admin\UserController@new');
        Route::get('/users/single/{id}','Admin\UserController@single');
        Route::get('/users/all','Admin\UserController@all');
        Route::post('/users/delete','Admin\UserController@delete');
        Route::post('/users/create','Admin\UserController@create');
        Route::post('/users/update','Admin\UserController@update');
        Route::get('/users/login/{id}','Admin\UserController@loginAs');

        Route::get('/companies/new','Admin\CompanyController@new');
        Route::get('/companies/single/{id}','Admin\CompanyController@single');
        Route::get('/companies/personels/{id}','Admin\CompanyController@personels');
        Route::get('/companies/sidedish/{id}','Admin\CompanyController@companySidedishes');
        Route::post('/companies/updatesidedishes','Admin\CompanyController@companySidedishesUpdate');
        Route::get('/companies/all','Admin\CompanyController@all');
        Route::post('/companies/delete','Admin\CompanyController@delete');
        Route::post('/companies/create','Admin\CompanyController@create');
        Route::post('/companies/update','Admin\CompanyController@update');
        Route::get('/companies/users/plan/{id}','Admin\CompanyController@userPlan');
        Route::post('/companies/users/updateplan/','Admin\CompanyController@userPlanUpdate');
        Route::get('/companies/users/daily/{id}','Admin\CompanyController@daily');
        Route::get('/companies/users/endofmonth/{id}','Admin\CompanyController@endOfMonth');

        Route::get('/materials/new','Admin\MaterialController@new');
        Route::get('/materials/single/{id}','Admin\MaterialController@single');
        Route::get('/materials/all','Admin\MaterialController@all');
        Route::post('/materials/delete','Admin\MaterialController@delete');
        Route::post('/materials/create','Admin\MaterialController@create');
        Route::post('/materials/update','Admin\MaterialController@update');

        Route::get('/plates/new','Admin\PlateController@new');
        Route::get('/plates/single/{id}','Admin\PlateController@single');
        Route::get('/plates/all','Admin\PlateController@all');
        Route::post('/plates/delete','Admin\PlateController@delete');
        Route::post('/plates/create','Admin\PlateController@create');
        Route::post('/plates/update','Admin\PlateController@update');

        Route::get('/userplate/single/{id}','Admin\UserplateController@single');
        Route::get('/userplate/all','Admin\UserplateController@all');
        Route::post('/userplate/delete','Admin\UserplateController@delete');
        Route::post('/userplate/update','Admin\UserplateController@update');

        Route::get('/dessert/new','Admin\DessertController@new');
        Route::get('/dessert/single/{id}','Admin\DessertController@single');
        Route::get('/dessert/duplicate/{id}','Admin\DessertController@duplicate');
        Route::get('/dessert/all','Admin\DessertController@all');
        Route::post('/dessert/delete','Admin\DessertController@delete');
        Route::post('/dessert/create','Admin\DessertController@create');
        Route::post('/dessert/update','Admin\DessertController@update');

        Route::get('/side/new','Admin\PackageController@new');
        Route::get('/side/single/{id}','Admin\PackageController@single');
        Route::get('/side/duplicate/{id}','Admin\PackageController@duplicate');
        Route::get('/side/all','Admin\PackageController@all');
        Route::post('/side/delete','Admin\PackageController@delete');
        Route::post('/side/create','Admin\PackageController@create');
        Route::post('/side/update','Admin\PackageController@update');

        Route::get('/plans/new','Admin\PlanController@new');
        Route::get('/plans/single/{id}','Admin\PlanController@single');
        Route::get('/plans/all','Admin\PlanController@all');
        Route::post('/plans/delete','Admin\PlanController@delete');
        Route::post('/plans/create','Admin\PlanController@create');
        Route::post('/plans/update','Admin\PlanController@update');

        Route::get('/calendar/all','Admin\CalendarController@all');
        Route::get('/calendar/view','Admin\CalendarController@view');

        Route::get('/hotbox/new','Admin\HotboxController@new');
        Route::get('/hotbox/single/{id}','Admin\HotboxController@single');
        Route::get('/hotbox/duplicate/{id}','Admin\HotboxController@duplicate');
        Route::get('/hotbox/all','Admin\HotboxController@all');
        Route::post('/hotbox/delete','Admin\HotboxController@delete');
        Route::post('/hotbox/create','Admin\HotboxController@create');
        Route::post('/hotbox/update','Admin\HotboxController@update');

        Route::get('/holiday/new','Admin\HolidayController@new');
        Route::get('/holiday/single/{id}','Admin\HolidayController@single');
        Route::get('/holiday/all','Admin\HolidayController@all');
        Route::post('/holiday/delete','Admin\HolidayController@delete');
        Route::post('/holiday/create','Admin\HolidayController@create');
        Route::post('/holiday/update','Admin\HolidayController@update');

        Route::get('/logistic','Admin\LogisticController@all');
        Route::post('/logistic/hotbox','Logistic\CompanyController@hotboxUpdate');

        Route::get('/profile','Admin\UserController@profile');
        Route::post('/profile','Admin\UserController@profileUpdate');
    });
});
Route::prefix('company')->group(function(){
    Route::middleware(['isCompany','web'])->group(function(){
        Route::get('/profile','Company\UserController@profile');
        Route::post('/profile','Company\UserController@profileUpdate');
        
        Route::get('/','Company\UserController@all');
        Route::get('/users/new','Company\UserController@new');
        Route::get('/users/single/{id}','Company\UserController@single');
        Route::get('/users/all','Company\UserController@all');
        Route::post('/users/delete','Company\UserController@delete');
        Route::post('/users/create','Company\UserController@create');
        Route::post('/users/update','Company\UserController@update');
        Route::get('/users/file','Company\UserController@file');
        Route::post('/users/upload','Company\UserController@upload');

        Route::get('/users/plan/{id}','Company\UserController@plan');
        Route::post('/users/updateplan','Company\UserController@planUpdate');

        Route::get('/users/login/{id}','Company\UserController@loginAs');

        Route::get('side/all','Company\PlanController@all');
        Route::post('plans/update','Company\PlanController@update');

        Route::get('meals/all','Company\PlanController@meals');
        Route::post('meals/update','Company\PlanController@mealUpdate');

        Route::get('day','Company\PlanController@day');
        Route::get('month','Company\PlanController@month');

        Route::get('hotbox','Company\PlanController@hotBox');
        Route::get('map/{id}','Company\PlanController@map');
        Route::get('cam','Company\UserController@cam');
        Route::get('polls','Company\PlanController@polls');
    });
});
