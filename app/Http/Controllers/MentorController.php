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

        // Cek jika tugas sudah berstatus 'certificate_ready', maka tidak bisa diubah lagi
        if ($assignment->status === 'certificate_ready') {
            return back()->with('error', 'Sertifikat sudah diunggah. Tugas tidak dapat diubah lagi.');
        }
        
        $request->validate([
            'mentor_feedback' => 'required|string',
            'status' => 'required|in:accepted,rejected',
        ]);

        $assignment->update([
            'mentor_feedback' => $request->mentor_feedback,
            'status' => $request->status,
        ]);

        $message = 'Umpan balik berhasil diberikan. ';

        if ($request->status === 'accepted') {
            $message .= 'Tugas disetujui, harap unggah sertifikat.';
        } elseif ($request->status === 'rejected') {
            $message .= 'Tugas perlu perbaikan.';
        }

        return redirect()->route('mentor.assignments.show', $assignment)->with('success', $message);
    }
    
    /**
     * Mengunggah file sertifikat (PNG) dan membuat record Certificate.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FinalAssignment  $assignment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function uploadCertificate(Request $request, FinalAssignment $assignment)
    {
        if ($assignment->mentor_id !== Auth::user()->mentor->id || $assignment->status !== 'accepted') {
            abort(403, 'Akses ditolak atau tugas belum disetujui.');
        }

        $request->validate([
            'certificate_file' => 'required|file|mimes:png,jpg,jpeg|max:5120', // Max 5MB, hanya PNG/JPG
        ]);

        $certificatePath = null;
        if ($request->hasFile('certificate_file')) {
            // Simpan file sertifikat ke storage
            $certificatePath = $request->file('certificate_file')->store('certificates', 'public');
        }

        // Cek apakah sertifikat sudah ada untuk menghindari duplikasi
        $certificate = Certificate::firstOrNew([
            'user_id' => $assignment->user->id,
            'course_id' => $assignment->course->id,
        ]);

        // Hapus file lama jika ada sebelum mengupdate
        if ($certificate->certificate_path && Storage::disk('public')->exists($certificate->certificate_path)) {
            Storage::disk('public')->delete($certificate->certificate_path);
        }

        $certificate->certificate_path = $certificatePath;
        $certificate->issued_at = now(); // Tambahkan kolom issued_at di model/migration
        $certificate->save();
        
        // Perbarui status tugas akhir menjadi 'certificate_ready'
        $assignment->update(['status' => 'certificate_ready']);

        return redirect()->route('mentor.assignments.show', $assignment)->with('success', 'Sertifikat berhasil diunggah dan siap diunduh oleh siswa.');
    }
}
