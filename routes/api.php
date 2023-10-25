<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{AuthController, ChatController, ContactController, EventController, GiftController, LogController, OcassionController, PaymentController, ScreenTextController, ToneController, UserController};
use App\Models\Ocassion;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
// Auth
Route::post('/login', [AuthController::class, 'login']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);
Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/user', [UserController::class, 'store']);
Route::post('/verify', [UserController::class, 'verify']);

Route::middleware('auth:api')->group(function () {

    //Auth
    Route::get('/current-user', [AuthController::class, 'currentUser']);
    Route::post('/profile-update', [AuthController::class, 'profileUpdate']);
    Route::post('/change-password', [AuthController::class, 'changePassword']);

    //Screen Text
    Route::get('/screen-text', [ScreenTextController::class, 'index']);
    Route::post('/screen-text', [ScreenTextController::class, 'store_or_update']);

    //user
    Route::get('/status/{id}', [UserController::class, 'status_change']);

    Route::apiResources([
        'user' => UserController::class,
    ], [
        'except' => ['store']
    ]);

    Route::apiResources([
        'log' => LogController::class,
        'contact' => ContactController::class,
        'event' => EventController::class,
        'ocassion' => OcassionController::class,
        'tone' => ToneController::class,
        'gift' => GiftController::class,
    ]);

    //chat
    Route::get('/allMessages', [ChatController::class, 'all_messages']);
    Route::get('/admin/show/chat/{id}', [ChatController::class, 'admin_show_chat']);
    Route::post('/message', [ChatController::class, 'message']);
    Route::post('/chats', [ChatController::class, 'chat']);

    //Gift Payment
    Route::post('/gift-payment', [PaymentController::class, 'gift_payment']);
});
