<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ConversationController;

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

Route::get('/chat', [ChatController::class, 'index'])->name('chat');
Route::get('/chat/{conversationId}', [ChatController::class, 'index']);

Route::get('/profile' , [ProfileController::class, 'edit'])->name('profile.edit');
Route::post('/profile' , [ProfileController::class, 'update'])->name('profile.post');

Route::get('/api/conversations' , [ConversationController::class, 'index']);
Route::get('/api/messages' , [MessageController::class, 'index']);

Route::post('/api/messages', [MessageController::class, 'store']);