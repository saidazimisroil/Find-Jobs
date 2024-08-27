<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionsController;
use App\Jobs\TranslateJob;
use App\Mail\JobPosted;
use App\Models\Job;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home');
Route::view('/contact', 'contact');

// Jobs
Route::group(['prefix' => 'jobs'], function () {
  Route::get('/', [JobController::class, 'index']);
  Route::get('/create', [JobController::class, 'create']);
  Route::post('/', [JobController::class, 'store'])->middleware('auth');
  Route::get('/{job}', [JobController::class, 'show']);

  Route::get('/{job}/edit', [JobController::class, 'edit'])
    ->middleware('auth')
    ->can('edit', 'job');

  Route::patch('/{job}', [JobController::class, 'update']);

  Route::delete('/{job}', [JobController::class, 'destroy'])
    ->middleware('auth')
    ->can('delete', 'job');
});

// Route::resource('jobs', JobController::class)->middleware('auth');

// Auth 
Route::get('/register', [RegisteredUserController::class, 'create']); 
Route::post('/register', [RegisteredUserController::class, 'store']); 

Route::get('/login', [SessionsController::class, 'create'])->name('login');
Route::post('/login', [SessionsController::class, 'store']); 
Route::post('/logout', [SessionsController::class, 'destroy']); 

// Log to the log file
Route::get('test', function () {
  $job = Job::first();

  TranslateJob::dispatch($job);

  // dispatch(function() {
  //   logger('hello from the queue!');
  // })->delay(5);

  return 'Done';
});

// -----------------    Other ways    ---------------------------------------
// Route::controller(JobController::class)->group(function () {
//     Route::get('/jobs', 'index');
//     Route::get('/jobs/create', 'create');
//     Route::post('/jobs', 'store');
//     Route::get('/jobs/{job}', 'show');
//     Route::get('/jobs/{job}/edit', 'edit');
//     Route::patch('/jobs/{job}', 'update');
//     Route::delete('/jobs/{job}', 'destroy');
// });

// Route::resource('jobs', JobController::class, [
//     'only' => ['index', 'show', 'create', 'store']
// ]);

// Route::resource('jobs', JobController::class, [
//     'except' => ['destroy']
// ]);