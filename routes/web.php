<?php

use App\Http\Controllers\Admin\TaskCategoryController;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Superadmin\ActivitiesController;
use App\Http\Controllers\Superadmin\AnnouncementsController;
use App\Http\Controllers\Superadmin\CategoriesController;
use App\Http\Controllers\Superadmin\DashboardController;
use App\Http\Controllers\Superadmin\GalleriesController as SuperadminGalleriesController;
use App\Http\Controllers\Superadmin\OrganizerController;
use App\Http\Controllers\Superadmin\PostsCategoriesController;
use App\Http\Controllers\Superadmin\PostsController as SuperadminPostsController;
use App\Http\Controllers\Superadmin\ProfilesController;
use App\Http\Controllers\Superadmin\ProgramsController;
use App\Http\Controllers\Superadmin\UserController as SuperadminUserController;
use Illuminate\Support\Benchmark;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('admin.dashboard');
});

Route::get('test', function () {
    Benchmark::dd(function () {
        (string) view('welcome');
    });
});

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'doLogin'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Users Routes
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('_admin.dashboard');
    })->name('dashboard');

    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/add', [UserController::class, 'add'])->name('add');
        Route::post('/create', [UserController::class, 'doCreate'])->name('create');
        Route::get('/detail/{id}', [UserController::class, 'detail'])->name('detail');
        Route::get('/update/{id}', [UserController::class, 'update'])->name('update');
        Route::post('/update/{id}', [UserController::class, 'doUpdate'])->name('doUpdate');
        Route::delete('/delete/{id}', [UserController::class, 'delete'])->name('delete');
        Route::post('/reset-password/{id}', [UserController::class, 'resetPassword'])->name('resetPassword');
    });

    Route::prefix('task-categories')->name('task_categories.')->group(function () {
        Route::get('/', [TaskCategoryController::class, 'index'])->name('index');
        Route::get('/add', [TaskCategoryController::class, 'add'])->name('add');
        Route::post('/create', [TaskCategoryController::class, 'doCreate'])->name('create');
        Route::get('/update/{id}', [TaskCategoryController::class, 'update'])->name('update');
        Route::post('/update/{id}', [TaskCategoryController::class, 'doUpdate'])->name('doUpdate');
        Route::delete('/delete/{id}', [TaskCategoryController::class, 'delete'])->name('delete');
    });

    Route::prefix('tasks')->name('tasks.')->group(function () {
        Route::get('/', [TaskController::class, 'index'])->name('index');
        Route::get('/add', [TaskController::class, 'add'])->name('add');
        Route::post('/create', [TaskController::class, 'doCreate'])->name('do_create');
        Route::get('/detail/{id}', [TaskController::class, 'detail'])->name('detail');
        Route::get('/update/{id}', [TaskController::class, 'update'])->name('update');
        Route::post('/update/{id}', [TaskController::class, 'doUpdate'])->name('do_update');
        Route::delete('/delete/{id}', [TaskController::class, 'delete'])->name('delete');
    });

    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/change-password', [UserController::class, 'changePassword'])->name('change_password');
        Route::post('/change-password', [UserController::class, 'doChangePassword'])->name('do_change_password');
        Route::get('/change-email', [UserController::class, 'changeEmail'])->name('change_email');
        Route::post('/change-email', [UserController::class, 'doChangeEmail'])->name('do_change_email');
    });
});

Route::middleware('auth')->prefix('superadmin')->name('superadmin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('announcements')->name('announcements.')->group(function () {
        Route::get('/', [AnnouncementsController::class, 'index'])->name('index');
        Route::get('/add', [AnnouncementsController::class, 'add'])->name('add');
        Route::post('/create', [AnnouncementsController::class, 'doCreate'])->name('create');
        Route::get('/detail/{id}', [AnnouncementsController::class, 'detail'])->name('detail');
        Route::get('/update/{id}', [AnnouncementsController::class, 'update'])->name('update');
        Route::post('/update/{id}', [AnnouncementsController::class, 'doUpdate'])->name('doUpdate');
        Route::delete('/delete/{id}', [AnnouncementsController::class, 'delete'])->name('delete');
        Route::delete('/force-delete/{id}', [AnnouncementsController::class, 'forceDelete'])->name('forceDelete');
        Route::post('/restore/{id}', [AnnouncementsController::class, 'restore'])->name('restore');
    });

    Route::prefix('activities')->name('activities.')->group(function () {
        Route::get('/', [ActivitiesController::class, 'index'])->name('index');
        Route::get('/add', [ActivitiesController::class, 'add'])->name('add');
        Route::get('/detail/{id}', [ActivitiesController::class, 'detail'])->name('detail');
        Route::post('/create', [ActivitiesController::class, 'doCreate'])->name('create');
        Route::get('/update/{id}', [ActivitiesController::class, 'update'])->name('update');
        Route::post('/update/{id}', [ActivitiesController::class, 'doUpdate'])->name('doUpdate');
        Route::delete('/delete/{id}', [ActivitiesController::class, 'delete'])->name('delete');
        Route::delete('/force-delete/{id}', [ActivitiesController::class, 'forceDelete'])->name('forceDelete');
        Route::post('/restore/{id}', [ActivitiesController::class, 'restore'])->name('restore');
    });

    Route::prefix('programs')->name('programs.')->group(function () {
        Route::get('/', [ProgramsController::class, 'index'])->name('index');
        Route::get('/add', [ProgramsController::class, 'add'])->name('add');
        Route::get('/detail/{id}', [ProgramsController::class, 'detail'])->name('detail');
        Route::post('/create', [ProgramsController::class, 'doCreate'])->name('create');
        Route::get('/update/{id}', [ProgramsController::class, 'update'])->name('update');
        Route::post('/update/{id}', [ProgramsController::class, 'doUpdate'])->name('doUpdate');
        Route::delete('/delete/{id}', [ProgramsController::class, 'delete'])->name('delete');
        Route::delete('/force-delete/{id}', [ProgramsController::class, 'forceDelete'])->name('forceDelete');
        Route::post('/restore/{id}', [ProgramsController::class, 'restore'])->name('restore');
    });

    Route::prefix('posts-categories')->name('posts_categories.')->group(function () {
        Route::get('/', [PostsCategoriesController::class, 'index'])->name('index');
        Route::get('/add', [PostsCategoriesController::class, 'add'])->name('add');
        Route::post('/create', [PostsCategoriesController::class, 'doCreate'])->name('create');
        Route::get('/edit/{id}', [PostsCategoriesController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [PostsCategoriesController::class, 'doUpdate'])->name('doUpdate');
        Route::delete('/delete/{id}', [PostsCategoriesController::class, 'delete'])->name('delete');
    });

    Route::prefix('posts')->name('posts.')->group(function () {
        Route::get('/', [SuperadminPostsController::class, 'index'])->name('index');
        Route::get('/add', [SuperadminPostsController::class, 'add'])->name('add');
        Route::get('/detail/{id}', [SuperadminPostsController::class, 'detail'])->name('detail');
        Route::post('/create', [SuperadminPostsController::class, 'doCreate'])->name('create');
        Route::get('/update/{id}', [SuperadminPostsController::class, 'update'])->name('update');
        Route::post('/update/{id}', [SuperadminPostsController::class, 'doUpdate'])->name('doUpdate');
        Route::get('/trash', [SuperadminPostsController::class, 'trash'])->name('trash');
        Route::delete('/delete/{id}', [SuperadminPostsController::class, 'delete'])->name('delete');
        Route::delete('/force-delete/{id}', [SuperadminPostsController::class, 'forceDelete'])->name('forceDelete');
        Route::post('/restore/{id}', [SuperadminPostsController::class, 'restore'])->name('restore');
        Route::post('/approve/{id}', [SuperadminPostsController::class, 'approve'])->name('approve');
        Route::post('/reject/{id}', [SuperadminPostsController::class, 'reject'])->name('reject');
        Route::post('/draft/{id}', [SuperadminPostsController::class, 'draft'])->name('draft');
    });

    Route::prefix('profiles')->name('profiles.')->group(function () {
        Route::get('/', [ProfilesController::class, 'index'])->name('index');
        Route::get('/add', [ProfilesController::class, 'add'])->name('add');
        Route::post('/create', [ProfilesController::class, 'doCreate'])->name('create');
        Route::get('/update/{id}', [ProfilesController::class, 'update'])->name('update');
        Route::post('/update/{id}', [ProfilesController::class, 'doUpdate'])->name('doUpdate');
        // Route::delete('/delete/{id}', [\App\Http\Controllers\Superadmin\ProfilesController::class, 'delete'])->name('delete');
    });

    Route::prefix('categories')->name('categories.')->group(function () {
        Route::get('/', [CategoriesController::class, 'index'])->name('index');
        Route::get('/add', [CategoriesController::class, 'add'])->name('add');
        Route::post('/create', [CategoriesController::class, 'do_create'])->name('do_create');
        Route::get('/update/{id}', [CategoriesController::class, 'update'])->name('update');
        Route::post('/update/{id}', [CategoriesController::class, 'do_update'])->name('do_update');
        Route::delete('/delete/{id}', [CategoriesController::class, 'delete'])->name('delete');
    });
    Route::prefix('organizer')->name('organizer.')->group(function () {
        Route::get('/', [OrganizerController::class, 'index'])->name('index');
        Route::get('/add', [OrganizerController::class, 'add'])->name('add');
        Route::post('/create', [OrganizerController::class, 'doCreate'])->name('doCreate');
        Route::get('/update/{id}', [OrganizerController::class, 'update'])->name('update');
        Route::post('/update/{id}', [OrganizerController::class, 'doUpdate'])->name('doUpdate');
        Route::delete('/delete/{id}', [OrganizerController::class, 'delete'])->name('delete');
        Route::post('/restore/{id}', [OrganizerController::class, 'restore'])->name('restore');
        Route::delete('/force-delete/{id}', [OrganizerController::class, 'forceDelete'])->name('forceDelete');
    });

    Route::group(['prefix' => 'galleries', 'as' => 'galleries.'], function () {
        Route::get('/', [SuperadminGalleriesController::class, 'index'])->name('index');
        Route::get('/add', [SuperadminGalleriesController::class, 'add'])->name('add');
        Route::post('/add', [SuperadminGalleriesController::class, 'doCreate'])->name('doCreate');
        Route::get('/update/{id}', [SuperadminGalleriesController::class, 'update'])->name('update');
        Route::post('/update/{id}', [SuperadminGalleriesController::class, 'doUpdate'])->name('doUpdate');
        Route::delete('/delete/{id}', [SuperadminGalleriesController::class, 'delete'])->name('delete');
        Route::post('/restore/{id}', [SuperadminGalleriesController::class, 'restore'])->name('restore');
        Route::delete('/force-delete/{id}', [SuperadminGalleriesController::class, 'forceDelete'])->name('forceDelete');
    });

    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [SuperadminUserController::class, 'index'])->name('index');
        Route::get('/add', [SuperadminUserController::class, 'add'])->name('add');
        Route::post('/create', [SuperadminUserController::class, 'doCreate'])->name('create');
        Route::get('/detail/{id}', [SuperadminUserController::class, 'detail'])->name('detail');
        Route::get('/update/{id}', [SuperadminUserController::class, 'update'])->name('update');
        Route::post('/update/{id}', [SuperadminUserController::class, 'doUpdate'])->name('doUpdate');
        Route::delete('/delete/{id}', [SuperadminUserController::class, 'delete'])->name('delete');
        Route::post('/reset-password/{id}', [SuperadminUserController::class, 'resetPassword'])->name('resetPassword');
    });
});
