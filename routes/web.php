<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeadController;
use App\Models\Lead;
use App\Http\Controllers\TaskController;
use App\Models\Task;
use App\Models\FollowUp;
use App\Http\Controllers\LeadNoteController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\FollowUpController;
use App\Http\Controllers\CalendarController;
use Carbon\Carbon;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KanbanController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\CompanySettingController;

use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource(
    'leads',
    LeadController::class
)->middleware('auth');

Route::resource(
    'tasks',
    TaskController::class
)->middleware('auth');
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

    Route::post('/lead-notes',[LeadNoteController::class,'store'])->middleware('auth')->name('lead-notes.store');
    Route::delete('/lead-notes/{leadNote}',[LeadNoteController::class, 'destroy'])->middleware('auth')->name('lead-notes.destroy');
    Route::put('/lead-notes/{leadNote}',[LeadNoteController::class,'update'])->middleware('auth')->name('lead-notes.update');
    Route::get(
      '/lead-notes/{leadNote}/edit',
            [LeadNoteController::class,'edit']
        )->middleware('auth')
        ->name('lead-notes.edit');

Route::resource('follow-ups', FollowUpController::class)->middleware('auth');
Route::get('/kanban',[KanbanController::class,'index'])
    ->middleware('auth')
    ->name('kanban.index');
Route::put('/kanban/{lead}',[LeadController::class,'updateStatus'])->middleware('auth')->name('kanban.update');
Route::get('/reports', [ReportController::class, 'index'])->name('reports.index')->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/leads/{lead}', [LeadController::class, 'show'])
    ->name('leads.show');
    Route::put('/follow-ups/{followUp}/complete',[FollowUpController::class, 'complete'])->name('follow-ups.complete');
    Route::delete('/follow-ups/{followUp}',[FollowUpController::class,'destroy'])->name('follow-ups.destroy');
    Route::get('/calendar',[CalendarController::class,'index'])
        ->name('calendar.index');

    Route::get('/calendar/events',[CalendarController::class,'events'])
        ->name('calendar.events');
    Route::put('/calendar/follow-up/{followUp}', [CalendarController::class, 'updateDate'])->name('calendar.update');
    Route::get('/reports/filter', [ReportController::class, 'filter'])->name('reports.filter');
    Route::get('/reports/export/excel',[ReportController::class,'exportExcel'])->name('reports.export.excel');
    // Route::get('/reports/export/pdf',[ReportController::class,'exportPdf'])->name('reports.export.pdf');
    Route::post('/reports/export/pdf', [ReportController::class, 'exportPdf'])
    ->name('reports.export.pdf');
    Route::get(
        '/settings/company',
        [CompanySettingController::class,'index']
    )->name('settings.company');

    Route::post(
        '/settings/company',
        [CompanySettingController::class,'store']
    )->name('settings.company.store');
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('users', UserController::class);

});

require __DIR__.'/auth.php';
