<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserAuthController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function () {
    Route::post('login', [UserAuthController::class, 'login']);
    Route::post('register', [UserAuthController::class, 'register']);
    Route::post('freelancerregister', [UserAuthController::class, 'freelancerregister']);
    Route::get('user-profile', [UserAuthController::class, 'userProfile']);


    Route::post('user-search', [UserAuthController::class, 'GetFreelancers']);
    Route::post('user-appiontment', [UserAuthController::class, 'PickAppointment']);
    Route::post('edit-name', [UserAuthController::class, 'EditName']);
    Route::post('edit-phone', [UserAuthController::class, 'EditPhone']);
    Route::post('edit-password', [UserAuthController::class, 'EditPassword']);
    Route::post('edit-image', [UserAuthController::class, 'EditImage']);
    Route::get('view-past-orders', [UserAuthController::class, 'ViewPastOrders']);
    Route::get('get-categories', [UserAuthController::class, 'GetCategories']);
    Route::get('get-regions', [UserAuthController::class, 'GetRegions']);
    Route::post('rate_freelancer', [UserAuthController::class, 'RateFreelancer']);


    Route::post('view-appointments', [UserAuthController::class, 'ViewAppointments']);
    Route::post('add-calendar', [UserAuthController::class, 'AddToCalendar']);
    Route::get('get-dates', [UserAuthController::class, 'GetDates']);
    Route::get('get-my-regions', [UserAuthController::class, 'GetMyRegions']);
    Route::get('get-connections', [UserAuthController::class, 'GetConnections']);
    Route::get('get-messages', [UserAuthController::class, 'GetMessages']);
    Route::post('send-message', [UserAuthController::class, 'SendMessage']);
    Route::post('add-region', [UserAuthController::class, 'AddRegion']);
    Route::post('remove-region', [UserAuthController::class, 'RemoveRegion']);
    Route::post('edit-price', [UserAuthController::class, 'EditPrice']);
    Route::post('edit-category', [UserAuthController::class, 'EditCategory']);
    Route::post('edit-appointment-status', [UserAuthController::class, 'EditAppointmentStatus']);
    Route::post('get-chat', [UserAuthController::class, 'GetChat']);
    Route::post('edit-region', [UserAuthController::class, 'EditRegion']);

    Route::get('get-freelancer-profile', [UserAuthController::class, 'freelancerProfile']);
    Route::post('edit-imagebase64', [UserAuthController::class, 'EditImagebase64']);

});


