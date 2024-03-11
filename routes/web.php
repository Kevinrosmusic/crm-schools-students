<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\API\SchoolController;
use App\Http\Controllers\API\StudentController;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('storage/{image}', function ($image) {
    $path = storage_path('app' . DIRECTORY_SEPARATOR . 'logos' . DIRECTORY_SEPARATOR . $image);
    return response()->file($path);
});

Route::resource('/api/schools', SchoolController::class);
Route::resource('/api/students', StudentController::class);

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/schools', function () {
    return Inertia::render('Schools/Index');
})->middleware(['auth', 'verified'])->name('schools');

Route::get('/schools/create', function () {
    return Inertia::render('Schools/Create');
})->middleware(['auth', 'verified'])->name('schools.create');

Route::get('/schools/{id}/edit', function ($id) {
    return Inertia::render('Schools/Edit', ['id' => $id]);
})->middleware(['auth', 'verified'])->name('schools.edit');

Route::get('/schools/{id}', function ($id) {
    return Inertia::render('Schools/Show', ['id' => $id]);
})->middleware(['auth', 'verified'])->name('schools.show');

Route::get('/students', function () {
    return Inertia::render('Students/Index');
})->middleware(['auth', 'verified'])->name('students');

Route::get('/students/create', function () {
    return Inertia::render('Students/Create');
})->middleware(['auth', 'verified'])->name('students.create');

Route::get('/students/{id}/edit', function ($id) {
    return Inertia::render('Students/Edit', ['id' => $id]);
})->middleware(['auth', 'verified'])->name('students.edit');

Route::get('/students/{id}', function ($id) {
    return Inertia::render('Students/Show', ['id' => $id]);
})->middleware(['auth', 'verified'])->name('students.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
