<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\DirectorController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\OptionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// User Registration
Route::get('/registerUser', [RegisterController::class, 'showRegister'])->name('showregister');

// Admin Routes
Route::prefix('admin')->middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])->group(function () {
    // User Management
    Route::delete('/users/{user}/delete', [UserController::class, 'destroy'])->name('admin.deleteUser');
    Route::post('/directors/{id}/activate', [UserController::class, 'activateDirector'])->name('admin.activateDirector');
    Route::post('/directors/{id}/deactivate', [UserController::class, 'deactivateDirector'])->name('admin.deactivateDirector');

    // School Management
    Route::get('/schools', [SchoolController::class, 'showSchoolsList'])->name('admin.schoolsList');
    Route::delete('/schools/{school}', [SchoolController::class, 'destroySchool'])->name('admin.destroySchool');
    Route::get('/school/create', [SchoolController::class, 'createSchool'])->name('admin.createSchool');
    Route::post('/school/create', [SchoolController::class, 'storeSchool'])->name('admin.storeSchool');
    Route::get('/school/{school}/update', [SchoolController::class, 'modifySchool'])->name('admin.modifySchool');
    Route::put('/school/{school}/update', [SchoolController::class, 'updateSchool'])->name('admin.updateSchool');
    Route::get('/school/{school}/details', [SchoolController::class, 'schoolDetails'])->name('admin.schoolDetails');

    // Director Management
    Route::get('/directors', [DirectorController::class, 'showDirectorsList'])->name('admin.directorsList');
});

// User Routes
Route::middleware('auth')->group(function () {
    Route::get('/users/{user}/update', [UserController::class, 'modifyUser'])->name('user.modifyUser');
    Route::put('/users/update/{user}', [UserController::class, 'update'])->name('user.update');
});

// Director Routes
Route::prefix('director')->middleware(['auth', \App\Http\Middleware\DirectorMiddleware::class])->group(function () {
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
    Route::get('/groups/create', [GroupController::class, 'createGroup'])->name('director.createGroup');
    Route::post('/groups/create', [GroupController::class, 'storeGroup'])->name('director.storeGroup');
    Route::get('/groups/{group}/update', [GroupController::class, 'editGroup'])->name('director.editGroup');
    Route::put('/groups/{group}/update', [GroupController::class, 'updateGroup'])->name('director.updateGroup');
    Route::delete('/groups/{group}/delete', [GroupController::class, 'destroyGroup'])->name('director.destroyGroup');

    // Option Management
    Route::get('/options', [OptionController::class, 'showOptionsList'])->name('director.showOptionsList');
    Route::get('/options/create', [OptionController::class,'createOption'])->name('director.createOption');
    Route::post('/options/create', [OptionController::class, 'storeOption'])->name('director.storeOption');
    Route::get('/options/{option}/update', [OptionController::class, 'editOption'])->name('director.editOption');
    Route::put('/options/{option}/update', [OptionController::class, 'updateOption'])->name('director.updateOption');
    Route::delete('/options/{option}/delete', [OptionController::class, 'destroyOption'])->name('director.destroyOption');

    // Modules Management
    Route::get('/modules', [ModuleController::class, 'showModulesList'])->name('director.showModulesList');
    Route::get('/modules/create', [ModuleController::class, 'createModule'])->name('director.createModule');
    Route::post('/modules/create', [ModuleController::class, 'storeModule'])->name('director.storeModule');
    Route::get('/modules/{module}/update', [ModuleController::class, 'editModule'])->name('director.editModule');
    Route::put('/modules/{module}/update', [ModuleController::class, 'updateModule'])->name('director.updateModule');
    Route::delete('/modules/{module}/delete', [ModuleController::class, 'destroyModule'])->name('director.deleteModule');

});

Route::prefix('professor')->middleware(['auth', \App\Http\Middleware\ProfessorMiddleware::class])->group(function () {
    // Exams Management
    Route::get('/exams', [ExamController::class, 'showExamsList'])->name('professor.showExamsList');
    Route::get('/exam/add', [ExamController::class, 'createExam'])->name('professor.crateExam');
    Route::post('/exams/add', [ExamController::class, 'storeExam'])->name('professor.storeExam');
    Route::get('/exam/{exam}/edit', [ExamController::class, 'editExam'])->name('professor.editExam');
    Route::put('/exam/{exam}/edit', [ExamController::class, 'updateExam'])->name('professor.updateExam');
    Route::delete('/exam/{exam}/delete', [ExamController::class, 'destroyExam'])->name('professor.destroyExam');
});

// Home Route
Route::get('/home', [HomeController::class, 'index'])->name('home');
