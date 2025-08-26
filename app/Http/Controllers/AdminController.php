<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mentor;
use App\Models\Course;
use App\Models\CourseAccess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{

    /**
     * Menampilkan dashboard admin.
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        $totalStudents = User::where('role', 'student')->count();
        $totalMentors = Mentor::count();
        $totalCourses = Course::count();
        $activeCourseAccesses = CourseAccess::where('is_active', true)->count();

        return view('admin.dashboard', compact('totalStudents', 'totalMentors', 'totalCourses', 'activeCourseAccesses'));
    }

    // --- Manajemen Mentor ---

    /**
     * Menampilkan daftar mentor.
     *
     * @return \Illuminate\View\View
     */
    public function mentors()
    {
        $mentors = Mentor::with('user')->paginate(10);
        return view('admin.mentors.index', compact('mentors'));
    }

    /**
     * Menampilkan form untuk membuat mentor baru.
     *
     * @return \Illuminate\View\View
     */
    public function createMentor()
    {
        return view('admin.mentors.create');
    }

    /**
     * Menyimpan mentor baru.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeMentor(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'mentor',
        ]);

        Mentor::create([
            'user_id' => $user->id,
        ]);

        return redirect()->route('admin.mentors.index')->with('success', 'Mentor berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit mentor.
     *
     * @param  \App\Models\Mentor  $mentor
     * @return \Illuminate\View\View
     */
    public function editMentor(Mentor $mentor)
    {
        return view('admin.mentors.edit', compact('mentor'));
    }

    /**
     * Memperbarui data mentor.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mentor  $mentor
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateMentor(Request $request, Mentor $mentor)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($mentor->user->id)],
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $mentor->user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        if ($request->filled('password')) {
            $mentor->user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect()->route('admin.mentors.index')->with('success', 'Data mentor berhasil diperbarui.');
    }

    /**
     * Menghapus mentor.
     *
     * @param  \App\Models\Mentor  $mentor
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteMentor(Mentor $mentor)
    {
        // Hapus juga user yang terkait
        $mentor->user->delete();
        $mentor->delete();

        return redirect()->route('admin.mentors.index')->with('success', 'Mentor berhasil dihapus.');
    }

    // --- Manajemen Kursus ---

    /**
     * Menampilkan daftar kursus.
     *
     * @return \Illuminate\View\View
     */
    public function courses()
    {
        $courses = Course::with('mentor.user')->paginate(10);
        return view('admin.courses.index', compact('courses'));
    }

    /**
     * Menampilkan form untuk membuat kursus baru.
     *
     * @return \Illuminate\View\View
     */
    public function createCourse()
    {
        $mentors = Mentor::with('user')->get();
        return view('admin.courses.create', compact('mentors'));
    }

    /**
     * Menyimpan kursus baru.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeCourse(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'thumbnail_url' => 'nullable|url', // Bisa diatur untuk upload file nantinya
            'mentor_id' => 'required|exists:mentors,id',
        ]);

        Course::create($request->all());

        return redirect()->route('admin.courses.index')->with('success', 'Kursus berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit kursus.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\View\View
     */
    public function editCourse(Course $course)
    {
        $mentors = Mentor::with('user')->get();
        return view('admin.courses.edit', compact('course', 'mentors'));
    }

    /**
     * Memperbarui data kursus.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateCourse(Request $request, Course $course)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'thumbnail_url' => 'nullable|url',
            'mentor_id' => 'required|exists:mentors,id',
        ]);

        $course->update($request->all());

        return redirect()->route('admin.courses.index')->with('success', 'Kursus berhasil diperbarui.');
    }

    /**
     * Menghapus kursus.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteCourse(Course $course)
    {
        // Kamu mungkin perlu menambahkan logika untuk menghapus video, tugas akhir, dan akses kursus terkait
        $course->delete();

        return redirect()->route('admin.courses.index')->with('success', 'Kursus berhasil dihapus.');
    }

    // --- Manajemen Akses Kursus Siswa ---

    /**
     * Menampilkan daftar akses kursus siswa.
     *
     * @return \Illuminate\View\View
     */
    public function courseAccesses()
    {
        $courseAccesses = CourseAccess::with('user', 'course')->paginate(10);
        return view('admin.course_accesses.index', compact('courseAccesses'));
    }

    /**
     * Menampilkan form untuk membuat akses kursus baru (opsional, bisa juga via WhatsApp admin).
     *
     * @return \Illuminate\View\View
     */
    public function createCourseAccess()
    {
        $users = User::where('role', 'student')->get();
        $courses = Course::all();
        return view('admin.course_accesses.create', compact('users', 'courses'));
    }

    /**
     * Menyimpan akses kursus baru.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeCourseAccess(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:courses,id',
            'is_active' => 'required|boolean',
        ]);

        CourseAccess::create($request->all());

        return redirect()->route('admin.course_accesses.index')->with('success', 'Akses kursus berhasil ditambahkan.');
    }

    /**
     * Mengaktifkan atau menonaktifkan akses kursus siswa.
     *
     * @param  \App\Models\CourseAccess  $courseAccess
     * @return \Illuminate\Http\RedirectResponse
     */
    public function toggleCourseAccess(CourseAccess $courseAccess)
    {
        $courseAccess->update(['is_active' => !$courseAccess->is_active]);

        return redirect()->route('admin.course_accesses.index')->with('success', 'Status akses kursus berhasil diperbarui.');
    }

    // --- Detail Kursus (Opsional, untuk melihat video, tugas, dll. dari sisi admin) ---

    /**
     * Menampilkan detail kursus tertentu (termasuk video, tugas, dll.).
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\View\View
     */
    public function showCourseDetail(Course $course)
    {
        $course->load('videos', 'finalAssignments.user', 'chats.user');
        return view('admin.courses.show', compact('course'));
    }
}
