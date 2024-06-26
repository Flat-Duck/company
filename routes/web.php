<?php

use App\Http\Controllers\ActivityController;
use App\Models\Activity;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MemoController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\InboxController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\SubFolderController;
use App\Http\Controllers\ExtoutboxController;
use App\Http\Controllers\IntoutboxController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\MainFolderController;
use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\AdministrationController;
use App\Http\Controllers\ReportController;

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
    $activities = Activity::latest()->paginate(5);
    return view('home',compact('activities'));
})->middleware('auth');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('/')
    ->middleware('auth')
    ->group(function () {
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);

        Route::resource('activities', ActivityController::class);
        Route::resource('users', UserController::class);
        Route::resource('administrations', AdministrationController::class);
        Route::resource('departments', DepartmentController::class);
        Route::resource('main-folders', MainFolderController::class);
        Route::resource('sub-folders', SubFolderController::class);
        Route::resource('offices', OfficeController::class);
        Route::resource('extoutboxes', ExtoutboxController::class);
        Route::resource('inboxes', InboxController::class);
        Route::resource('intoutboxes', IntoutboxController::class);
        Route::resource('memos', MemoController::class);
        Route::resource('attachments', AttachmentController::class);



        Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
        Route::get('reports/messages', [ReportController::class, 'messages'])->name('reports.messages');
        Route::get('reports/main_folders', [ReportController::class, 'main_folders'])->name('reports.main_folders');
        Route::get('reports/sub_folders', [ReportController::class, 'sub_folders'])->name('reports.sub_folders');
        Route::get('reports/users', [ReportController::class, 'users'])->name('reports.users');
        Route::get('reports/activity', [ReportController::class, 'activity'])->name('reports.activity');

        Route::get('profile', [
            \App\Http\Controllers\ProfileController::class,
            'show',
        ])->name('profile.show');
        Route::put('profile', [
            \App\Http\Controllers\ProfileController::class,
            'update',
        ])->name('profile.update');
    });
