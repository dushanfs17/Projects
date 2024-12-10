<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceCategoryController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\IndustryController;
use App\Http\Controllers\TeamMemberController;
use App\Http\Controllers\PartnerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ContactFormController;
use App\Http\Controllers\PositionController;
use Illuminate\Support\Facades\DB;

Route::get('/', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/', function () {
    $jobStats = DB::table('jobs')
        ->select(DB::raw('MONTH(published_at) as month'), DB::raw('count(*) as job_count'))
        ->whereBetween('published_at', [now()->subYear(), now()])
        ->groupBy(DB::raw('MONTH(published_at)'))
        ->orderBy(DB::raw('MONTH(published_at)'), 'asc')
        ->get();

    return view('dashboard', compact('jobStats'));
})->middleware(['auth', 'verified'])->name('dashboard');

// Routes for messages
Route::get('/messages/{id}', [ContactFormController::class, 'show'])->name('messages.show');
Route::delete('/messages/{id}', [ContactFormController::class, 'destroy'])->name('messages.destroy');
Route::post('/messages/{id}/read', [ContactFormController::class, 'markAsRead'])->name('messages.read');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Resource routes for dashboard
Route::middleware(['auth'])->prefix('dashboard')->group(function () {
    Route::resource('service-categories', ServiceCategoryController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('testimonials', TestimonialController::class);
    Route::resource('jobs', JobController::class);
    Route::resource('industries', IndustryController::class);
    Route::resource('team-members', TeamMemberController::class);
    Route::resource('partners', PartnerController::class);
    Route::resource('positions', PositionController::class);
});

require __DIR__ . '/auth.php';
