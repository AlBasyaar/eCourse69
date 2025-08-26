<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseVideo;
use App\Models\FinalAssignment;
use App\Models\Certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; // Tambahkan ini

class MentorController extends Controller
{
   

    /**
     * Menampilkan dashboard mentor.
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        $mentor = Auth::user()->mentor;
        $courses = $mentor->courses; // Mengambil semua kursus yang diajar mentor ini
        $totalAssignments = FinalAssignment::where('mentor_id', $mentor->id)->count();
        $pendingAssignments = FinalAssignment::where('mentor_id', $mentor->id)->where('status', 'pending')->count();

        return view('mentor.dashboard', compact('courses', 'totalAssignments', 'pendingAssignments'));
    }

    /**
     * Menampilkan daftar kursus yang diajar oleh mentor.
     *
     * @return \Illuminate\View\View
     */
    public function myCourses()
    {
        $mentor = Auth::user()->mentor;
        $courses = $mentor->courses()->paginate(10);
        return view('mentor.courses.index', compact('courses'));
    }

    /**
     * Menampilkan detail kursus tertentu yang diajar oleh mentor.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\View\View
     */
    public function showCourse(Course $course)
    {
        // Pastikan mentor yang login adalah mentor yang mengajar kursus ini
        if ($course->mentor_id !== Auth::user()->mentor->id) {
            abort(403, 'Anda tidak memiliki akses ke kursus ini.');
        }

        $course->load('videos', 'finalAssignments.user', 'chats.user');
        return view('mentor.courses.show', compact('course'));
    }

    // --- Manajemen Video Kursus (Dipindahkan ke CourseVideoController) ---
    // Logika di sini telah dipindahkan ke CourseVideoController

    // --- Manajemen Tugas Akhir ---

    /**
     * Menampilkan daftar tugas akhir siswa untuk kursus yang diajar mentor.
     *
     * @return \Illuminate\View\View
     */
    public function finalAssignments()
    {
        $mentor = Auth::user()->mentor;
        $assignments = FinalAssignment::where('mentor_id', $mentor->id)
                                    ->with('user', 'course')
                                    ->paginate(10);
        return view('mentor.assignments.index', compact('assignments'));
    }

    /**
     * Menampilkan detail tugas akhir siswa.
     *
     * @param  \App\Models\FinalAssignment  $assignment
     * @return \Illuminate\View\View
     */
    public function showAssignment(FinalAssignment $assignment)
    {
        if ($assignment->mentor_id !== Auth::user()->mentor->id) {
            abort(403, 'Anda tidak memiliki akses ke tugas ini.');
        }
        return view('mentor.assignments.show', compact('assignment'));
    }

    /**
     * Memberikan umpan balik dan mengubah status tugas akhir.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FinalAssignment  $assignment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function giveFeedback(Request $request, FinalAssignment $assignment)
    {
        if ($assignment->mentor_id !== Auth::user()->mentor->id) {
            abort(403, 'Anda tidak memiliki akses untuk memberikan umpan balik pada tugas ini.');
        }

        $request->validate([
            'mentor_feedback' => 'required|string',
            'status' => 'required|in:accepted,rejected', // 'pending', 'accepted', 'rejected'
        ]);

        $assignment->update([
            'mentor_feedback' => $request->mentor_feedback,
            'status' => $request->status,
        ]);

        // Jika tugas diterima, buat sertifikat
        if ($request->status === 'accepted') {
            // Logika untuk membuat sertifikat (misalnya generate PDF, simpan path)
            // Untuk contoh ini, kita hanya akan menyimpan path placeholder
            // Anda perlu mengganti ini dengan logika pembuatan PDF yang sebenarnya
            $certificatePath = 'certificates/' . $assignment->user->id . '_' . $assignment->course->id . '_' . time() . '.pdf';

            // Contoh sederhana: Storage::disk('public')->put($certificatePath, 'Konten sertifikat untuk ' . $assignment->user->name);
            // Anda akan mengintegrasikan pustaka PDF generator di sini
            // Misalnya: $pdf = App::make('dompdf.wrapper'); $pdf->loadHTML('<h1>Sertifikat</h1>...'); $pdf->save(storage_path('app/public/' . $certificatePath));

            Certificate::create([
                'user_id' => $assignment->user->id,
                'course_id' => $assignment->course->id,
                'certificate_path' => $certificatePath, // Ini perlu diisi dengan path file sertifikat yang sebenarnya
            ]);

            // Opsional: Kirim notifikasi ke siswa
        }

        return redirect()->route('mentor.assignments.index')->with('success', 'Umpan balik berhasil diberikan dan status tugas diperbarui.');
    }
}
