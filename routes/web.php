<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MentorController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseVideoController; // Tambahkan import ini
use App\Http\Controllers\ChatController;

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

Route::get('/', function () {
    return view('welcome');
});

// Auth Routes
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Mentor Management
    Route::get('mentors', [AdminController::class, 'mentors'])->name('mentors.index');
    Route::get('mentors/create', [AdminController::class, 'createMentor'])->name('mentors.create');
    Route::post('mentors', [AdminController::class, 'storeMentor'])->name('mentors.store');
    Route::get('mentors/{mentor}/edit', [AdminController::class, 'editMentor'])->name('mentors.edit');
    Route::put('mentors/{mentor}', [AdminController::class, 'updateMentor'])->name('mentors.update');
    Route::delete('mentors/{mentor}', [AdminController::class, 'deleteMentor'])->name('mentors.delete');

    // Course Management
    Route::get('courses', [AdminController::class, 'courses'])->name('courses.index');
    Route::get('courses/create', [AdminController::class, 'createCourse'])->name('courses.create');
    Route::post('courses', [AdminController::class, 'storeCourse'])->name('courses.store');
    Route::get('courses/{course}/edit', [AdminController::class, 'editCourse'])->name('courses.edit');
    Route::put('courses/{course}', [AdminController::class, 'updateCourse'])->name('courses.update');
    Route::delete('courses/{course}', [AdminController::class, 'deleteCourse'])->name('courses.delete');
    Route::get('courses/{course}', [AdminController::class, 'showCourseDetail'])->name('courses.show'); // Untuk melihat detail kursus

    // Course Access Management
    Route::get('course-accesses', [AdminController::class, 'courseAccesses'])->name('course_accesses.index');
    Route::get('course-accesses/create', [AdminController::class, 'createCourseAccess'])->name('course_accesses.create');
    Route::post('course-accesses', [AdminController::class, 'storeCourseAccess'])->name('course_accesses.store');
    Route::put('course-accesses/{courseAccess}/toggle', [AdminController::class, 'toggleCourseAccess'])->name('course_accesses.toggle');
});

// Mentor Routes
Route::middleware(['auth', 'role:mentor'])->prefix('mentor')->name('mentor.')->group(function () {
    Route::get('dashboard', [MentorController::class, 'dashboard'])->name('dashboard');
    Route::get('my-courses', [MentorController::class, 'myCourses'])->name('courses.index');
    Route::get('courses/{course}', [MentorController::class, 'showCourse'])->name('courses.show');

    // Video Management for Mentor (Sekarang menggunakan CourseVideoController)
    Route::get('courses/{course}/videos/create', [CourseVideoController::class, 'create'])->name('videos.create');
    Route::post('courses/{course}/videos', [CourseVideoController::class, 'store'])->name('videos.store');
    Route::get('videos/{courseVideo}/edit', [CourseVideoController::class, 'edit'])->name('videos.edit');
    Route::put('videos/{courseVideo}', [CourseVideoController::class, 'update'])->name('videos.update');
    Route::delete('videos/{courseVideo}', [CourseVideoController::class, 'destroy'])->name('videos.delete');


    // Final Assignment Management for Mentor
    Route::get('assignments', [MentorController::class, 'finalAssignments'])->name('assignments.index');
    Route::get('assignments/{assignment}', [MentorController::class, 'showAssignment'])->name('assignments.show');
    Route::put('assignments/{assignment}/feedback', [MentorController::class, 'giveFeedback'])->name('assignments.feedback');
});

// Student Routes
Route::middleware(['auth', 'role:student'])->prefix('student')->name('student.')->group(function () {
    Route::get('dashboard', [StudentController::class, 'dashboard'])->name('dashboard');
    Route::get('courses', [StudentController::class, 'courses'])->name('courses.index');
    Route::get('courses/{course}', [StudentController::class, 'showCourse'])->name('courses.show');
    Route::get('courses/{course}/videos/{video}', [StudentController::class, 'showVideo'])->name('courses.video');
    Route::post('courses/{course}/submit-assignment', [StudentController::class, 'submitAssignment'])->name('courses.submitAssignment');

    Route::get('certificates', [StudentController::class, 'certificates'])->name('certificates.index');
    Route::get('certificates/{certificate}/download', [StudentController::class, 'downloadCertificate'])->name('certificates.download');
});


// Chat Routes (Shared for Student and Mentor)
Route::middleware(['auth'])->prefix('chats')->name('chats.')->group(function () {
    Route::get('course/{course}', [ChatController::class, 'showCourseChat'])->name('course.show');
    Route::post('course/{course}', [ChatController::class, 'sendCourseChatMessage'])->name('course.send');

    Route::get('mentor', [ChatController::class, 'showMentorChats'])->name('mentor.index');
    Route::get('mentor/{otherUser}', [ChatController::class, 'showMentorChatDetail'])->name('mentor.show');
    Route::post('mentor/{receiver}', [ChatController::class, 'sendMentorChatMessage'])->name('mentor.send');
});
