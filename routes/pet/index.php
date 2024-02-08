<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pet\PetController;
use App\Http\Controllers\Pet\ActividadController;
use App\Http\Controllers\Pet\SemanaController;


Auth::routes();
Route::get('/pet/index', [PetController::class, 'index'])->name('pet.index');
Route::post('/pet/store', [PetController::class, 'store'])->name('pet.store');
Route::get('/pet/actividades/index', [ActividadController::class, 'index'])->name('pet.actividades.index');
Route::post('/pet/actividades/subject/store', [ActividadController::class, 'subjectStore'])->name('pet.subject.store');
Route::post('/pet/actividades/activity/store', [ActividadController::class, 'store'])->name('pet.activity.store');
Route::get('/pet/semanas/index', [SemanaController::class, 'index'])->name('pet.semana.index');
Route::post('/pet/semanas/store', [SemanaController::class, 'store'])->name('pet.semana.store');



