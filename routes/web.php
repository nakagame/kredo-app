<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\ClassroomController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\TeachersController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

Route::group(['middleware' => 'auth'], function() {
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('/profile', [HomeController::class, 'show'])->name('profile');
    Route::patch('/profile/update', [HomeController::class, 'update'])->name('update');


    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function() {
        // classes
        Route::get('/class/all', [ClassroomController::class, 'index'])->name('classroom');
        Route::get('/class/create', [ClassroomController::class, 'create'])->name('classroom.create');
        Route::get('/class/history', [ClassroomController::class, 'show'])->name('classroom.history');
        Route::post('/class/store', [ClassroomController::class, 'store'])->name('classroom.store');

        // teachers
        Route::get('/teacher/all', [TeacherController::class, 'index'])->name('teachers');
        Route::get('/teacher/search', [TeacherController::class, 'search'])->name('teachers.search');
        Route::get('/teacher/create', [TeacherController::class, 'create'])->name('teachers.create');
        Route::post('/teacher/store', [TeacherController::class, 'store'])->name('teachers.store');
        Route::patch('/teacher/{id}/inactive', [TeacherController::class, 'inactive'])->name('teachers.inactive');
        Route::delete('/teacher/{id}/deactive', [TeacherController::class, 'deactive'])->name('teachers.deactive');

        // students
        Route::get('/student/all', [StudentController::class, 'index'])->name('students');
        Route::get('/student/search', [StudentController::class, 'search'])->name('students.search');
        Route::get('/student/create', [StudentController::class, 'create'])->name('students.create');
        Route::post('/student/store', [StudentController::class, 'store'])->name('students.store');
        Route::patch('/student/{id}/inactive', [StudentController::class, 'inactive'])->name('students.inactive');
        Route::delete('/student/{id}/deactive', [StudentController::class, 'deactive'])->name('students.deactive');

        // courses
        Route::get('/courses/all', [CourseController::class, 'index'])->name('courses');
        Route::post('/courses/store', [CourseController::class, 'store'])->name('courses.store');
        Route::patch('/courses/{id}/show', [CourseController::class, 'show'])->name('courses.show');
        Route::delete('/courses/{id}/hide', [CourseController::class, 'hide'])->name('courses.hide');
    });

    // Student
    Route::group(['prefix' => 'student', 'as' => 'student.'], function() {
        Route::get('/', [StudentsController::class, 'index'])->name('index');
        Route::get('/history', [StudentsController::class, 'show'])->name('show');

        Route::patch('/{id}/update', [StudentsController::class, 'update'])->name('update');
        Route::patch('/{id}/cancel', [StudentsController::class, 'cancel'])->name('cancel');
    });

    // Teacher
    Route::group(['prefix' => 'teacher', 'as' => 'teacher.'], function() {
        Route::get('/', [TeachersController::class, 'index'])->name('index');
        Route::get('/history', [TeachersController::class, 'show'])->name('show');
        Route::patch('/{id}/revert-class', [TeachersController::class, 'revertClass'])->name('revert-class');
        Route::delete('/{id}/destroy', [TeachersController::class, 'destroy'])->name('destroy');
    });
});

