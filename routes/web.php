<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\DirectorController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\UserController;

// Public Routes
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// User Registration
Route::get('/registerUser', [RegisterController::class, 'showRegister'])->name('showregister');

// Routes that require authentication
Route::middleware('auth')->group(function () {
    // User Management
    Route::get('/users/{user}/update', [UserController::class, 'modifyUser'])->name('user.modifyUser');
    Route::put('/users/update/{user}', [UserController::class, 'update'])->name('user.update');

    // Director Routes
    Route::prefix('director')->middleware(\App\Http\Middleware\DirectorMiddleware::class)->group(function () {
        // Activate / Deactivate Student and Professor
        Route::post('/users/{id}/activate', [DirectorController::class, 'activateStudentOrProfessor'])->name('director.activateStudentOrProfessor');
        Route::post('/users/{id}/deactivate', [DirectorController::class, 'deactivateStudentOrProfessor'])->name('director.deactivateStudentOrProfessor');
       
        // User Management
        Route::delete('/users/{user}/delete', [UserController::class, 'destroy'])->name('admin.deleteUser');

        // Professor Management
        Route::get('/professors', [DirectorController::class, 'showProfessorsList'])->name('director.showProfessorsList');

        // Student Management
        Route::get('/students', [DirectorController::class, 'showStudentsList'])->name('director.showStudentsList');

        // Group Management
        Route::get('/groups', [GroupController::class, 'showGroupsList'])->name('director.showGroupsList');
        Route::get('/groups/create', [GroupController::class, 'create'])->name('director.createGroup');
        Route::post('/groups', [GroupController::class, 'store'])->name('director.storeGroup');
        Route::get('/groups/{group}/edit', [GroupController::class, 'edit'])->name('director.editGroup');
        Route::put('/groups/{group}', [GroupController::class, 'update'])->name('director.updateGroup');
        Route::delete('/groups/{group}', [GroupController::class, 'destroy'])->name('director.destroyGroup');

        // Option Management
        Route::get('/options', [OptionController::class, 'showOptionsList'])->name('director.showOptionsList');
        Route::get('/options/create', [OptionController::class,'create'])->name('director.createOption');
        Route::post('/options', [OptionController::class, 'store'])->name('director.storeOption');
        Route::get('/options/{option}/edit', [OptionController::class, 'edit'])->name('director.editOption');
        Route::put('/options/{option}', [OptionController::class, 'update'])->name('director.updateOption');
        Route::delete('/options/{option}', [OptionController::class, 'destroy'])->name('director.destroyOption');

        // Modules Management
        Route::get('/modules', [ModuleController::class, 'showModulesList'])->name('director.showModulesList');
        Route::get('/modules/create', [ModuleController::class, 'create'])->name('director.createModule');
        Route::post('/modules', [ModuleController::class, 'store'])->name('director.storeModule');
        Route::get('/modules/{module}/edit', [ModuleController::class, 'edit'])->name('director.editModule');
        Route::put('/modules/{module}', [ModuleController::class, 'update'])->name('director.updateModule');
        Route::delete('/modules/{module}', [ModuleController::class, 'destroy'])->name('director.deleteModule');
    });

    // Professor Routes
    Route::prefix('professor')->middleware(\App\Http\Middleware\ProfessorMiddleware::class)->group(function () {
        Route::get('/exams', [ExamController::class, 'showExamsList'])->name('professor.showExamsList');
        Route::get('/exam/add', [ExamController::class, 'create'])->name('professor.createExam');
        Route::post('/exam', [ExamController::class, 'store'])->name('professor.storeExam');
        Route::get('/exam/{exam}/edit', [ExamController::class, 'edit'])->name('professor.editExam');
        Route::put('/exam/{exam}', [ExamController::class, 'update'])->name('professor.updateExam');
        Route::delete('/exam/{exam}', [ExamController::class, 'destroy'])->name('professor.destroyExam');
    });

    // Admin Routes
    Route::prefix('admin')->middleware(\App\Http\Middleware\AdminMiddleware::class)->group(function () {
        // User Management
        Route::delete('/users/{user}/delete', [UserController::class, 'destroy'])->name('admin.deleteUser');
        Route::post('/directors/{id}/activate', [UserController::class, 'activateDirector'])->name('admin.activateDirector');
        Route::post('/directors/{id}/deactivate', [UserController::class, 'deactivateDirector'])->name('admin.deactivateDirector');

        // School Management
        Route::get('/schools', [SchoolController::class, 'showSchoolsList'])->name('admin.schoolsList');
        Route::delete('/schools/{school}', [SchoolController::class, 'destroySchool'])->name('admin.destroySchool');
        Route::get('/school/create', [SchoolController::class, 'create'])->name('admin.createSchool');
        Route::post('/school', [SchoolController::class, 'store'])->name('admin.storeSchool');
        Route::get('/school/{school}/edit', [SchoolController::class, 'edit'])->name('admin.modifySchool');
        Route::put('/school/{school}', [SchoolController::class, 'update'])->name('admin.updateSchool');
        Route::get('/school/{school}/details', [SchoolController::class, 'show'])->name('admin.schoolDetails');

        // Director Management
        Route::get('/directors', [DirectorController::class, 'showDirectorsList'])->name('admin.directorsList');
    });
});

// Home Route
Route::get('/home', [HomeController::class, 'index'])->name('home');
