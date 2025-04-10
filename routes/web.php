<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\ApplicantController;

// Home route
Route::get('/', [HomeController::class, 'index'])->name('home');

// Job search
Route::get('/jobs/search', [JobController::class, 'search'])->name('jobs.search'); 


// Job resource routes
// Route::resource('jobs', JobController::class);
Route::resource('jobs', JobController::class)->middleware('auth')->only(['create', 'edit', 'update', 'destroy']);
Route::resource('jobs', JobController::class)->except(['create', 'edit', 'update', 'destroy']);

Route::middleware('guest')->group(function(){
   // Register routes
Route::get('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

// Login routes
Route::get('/login', [LoginController::class, 'login'])->name('login'); 
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate'); 
});

// Logout route
Route::post('/logout', [LoginController::class, 'logout'])->name('logout'); 

// Dashboard route
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth'); 

// Profile route
Route::PUT('/profile', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');

Route::middleware('auth')->group(function() {
   Route::get('/bookmarks', [BookmarkController::class, 'index'])->name('bookmarks.index'); 
   Route::post('/bookmarks/{job}', [BookmarkController::class, 'store'])->name('bookmarks.store'); // Change GET to POST
   Route::delete('/bookmarks/{job}', [BookmarkController::class, 'destroy'])->name('bookmarks.destroy'); 
});

// Applicant route
Route::post('/jobs/{job}/apply', [ApplicantController::class, 'store'])->name('applicant.store')->middleware('auth'); 
Route::delete('/applicants/{applicant}/', [ApplicantController::class, 'destroy'])->name('applicant.destroy')->middleware('auth'); 

