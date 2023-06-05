<?php

use App\Http\Controllers\AdminPanel\AdminUserController;
use App\Http\Controllers\AdminPanel\HomeController as AdminHomeController;
use App\Http\Controllers\AdminPanel\PasswordController as AdminPasswordController;
use App\Http\Controllers\AdminPanel\ProductController as AdminProductController;
use App\Http\Controllers\AdminPanel\ProfileController as AdminProfileController;
use App\Http\Controllers\AdminPanel\AnnouncementController as AdminAnnouncementController;
use App\Http\Controllers\AdminPanel\ChatController as AdminChatController;
use App\Http\Controllers\AdminPanel\MessageController as AdminMessageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserPanel\HomeController as UserHomeController;
use App\Http\Controllers\UserPanel\ProductController as UserProductController;
use App\Http\Controllers\UserPanel\PasswordController as UserPasswordController;
use App\Http\Controllers\UserPanel\ProfileController as UserProfileController;
use App\Http\Controllers\UserPanel\AnnouncementController as UserAnnouncementController;
use App\Http\Controllers\UserPanel\ChatController as UserChatController;
use App\Http\Controllers\UserPanel\MessageController as UserMessageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::view('/register', 'home.register')->name('register');
Route::post('/store', [AuthController::class, 'store'])->name('store');
Route::view('/login', 'home.login')->name('login');

Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [AdminHomeController::class, 'index'])->name('index');

        Route::prefix('product')->name('product.')->group(function () {
            Route::get('/', [AdminProductController::class, 'index'])->name('index');
            Route::get('/create', [AdminProductController::class, 'create'])->name('create');
            Route::post('/store', [AdminProductController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [AdminProductController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [AdminProductController::class, 'update'])->name('update');
            Route::get('/destroy/{id}', [AdminProductController::class, 'destroy'])->name('destroy');
            Route::get('/show/{id}', [AdminProductController::class, 'show'])->name('show');
            Route::get('/search', [AdminProductController::class, 'search'])->name('search');
        });

        Route::prefix('user')->name('user.')->group(function () {
            Route::get('/', [AdminUserController::class, 'index'])->name('index');
            Route::get('/create', [AdminUserController::class, 'create'])->name('create');
            Route::post('/store', [AdminUserController::class, 'store'])->name('store');
            Route::get('/show/{id}', [AdminUserController::class, 'show'])->name('show');
            Route::get('/edit/{id}', [AdminUserController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [AdminUserController::class, 'update'])->name('update');
            Route::get('/destroy/{id}', [AdminUserController::class, 'destroy'])->name('destroy');
            Route::post('/addrole/{id}', [AdminUserController::class, 'addRole'])->name('addrole');
            Route::get('/destroyrole/{uid}/{rid}', [AdminUserController::class, 'destroyRole'])->name('destroyrole');
            Route::get('/search', [AdminUserController::class, 'search'])->name('search');
        });

        Route::prefix('password')->name('password.')->group(function () {
            Route::post('/update', [AdminPasswordController::class, 'update'])->name('update');
            Route::post('/reset/{id}', [AdminPasswordController::class, 'reset'])->name('reset');
        });

        Route::prefix('profile')->name('profile.')->group(function () {
            Route::get('/edit/{id}', [AdminProfileController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [AdminProfileController::class, 'update'])->name('update');
            Route::get('/destroy/{id}', [AdminProfileController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('announcement')->name('announcement.')->group(function () {
            Route::get('/', [AdminAnnouncementController::class, 'index'])->name('index');
            Route::get('/create', [AdminAnnouncementController::class, 'create'])->name('create');
            Route::post('/store', [AdminAnnouncementController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [AdminAnnouncementController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [AdminAnnouncementController::class, 'update'])->name('update');
            Route::get('/destroy/{id}', [AdminAnnouncementController::class, 'destroy'])->name('destroy');
            Route::get('/show/{id}', [AdminAnnouncementController::class, 'show'])->name('show');
            Route::get('/publish/{id}', [AdminAnnouncementController::class, 'publish'])->name('publish');
            Route::get('/search', [AdminAnnouncementController::class, 'search'])->name('search');
        });

        Route::prefix('chat')->name('chat.')->group(function () {
            Route::get('/', [AdminChatController::class, 'index'])->name('index');
            Route::get('/create', [AdminChatController::class, 'create'])->name('create');
            Route::post('/store', [AdminChatController::class, 'store'])->name('store');
            Route::get('/show/{id}', [AdminChatController::class, 'show'])->name('show');
        });

        Route::prefix('message')->name('message.')->group(function () {
            Route::post('/store', [AdminMessageController::class, 'store'])->name('store');
        });
    });

    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/', [UserHomeController::class, 'index'])->name('index');

        Route::prefix('product')->name('product.')->group(function () {
            Route::get('/', [UserProductController::class, 'index'])->name('index');
            Route::get('/show/{id}', [UserProductController::class, 'show'])->name('show');
            Route::get('/search', [UserProductController::class, 'search'])->name('search');
        });

        Route::prefix('password')->name('password.')->group(function () {
            Route::post('/update', [UserPasswordController::class, 'update'])->name('update');
        });

        Route::prefix('profile')->name('profile.')->group(function () {
            Route::get('/edit/{id}', [UserProfileController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [UserProfileController::class, 'update'])->name('update');
            Route::get('/destroy/{id}', [UserProfileController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('announcement')->name('announcement.')->group(function () {
            Route::get('/', [UserAnnouncementController::class, 'index'])->name('index');
            Route::get('/show/{id}', [UserAnnouncementController::class, 'show'])->name('show');
            Route::get('/search', [UserAnnouncementController::class, 'search'])->name('search');
        });

        Route::prefix('chat')->name('chat.')->group(function () {
            Route::get('/', [UserChatController::class, 'index'])->name('index');
            Route::get('/create', [UserChatController::class, 'create'])->name('create');
            Route::post('/store', [UserChatController::class, 'store'])->name('store');
            Route::get('/show/{id}', [UserChatController::class, 'show'])->name('show');
        });

        Route::prefix('message')->name('message.')->group(function () {
            Route::post('/store', [UserMessageController::class, 'store'])->name('store');
        });
    });
});