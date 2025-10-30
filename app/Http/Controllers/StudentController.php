<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseAccess;
use App\Models\CourseVideo;
use App\Models\FinalAssignment;
use App\Models\Certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; // Tambahkan ini

class StudentController extends Controller
{
 

    /**
     * Menampilkan dashboard siswa.
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        $user = Auth::user();
        $enrolledCourses = $user->courseAccesses()->where('is_active', true)->with('course')->get();
        $pendingAssignments = $user->finalAssignments()->where('status', 'pending')->count();
        $completedCourses = $user->certificates()->count();

        return view('student.dashboard', compact('enrolledCourses', 'pendingAssignments', 'completedCourses'));
    }

    /**
     * Menampilkan daftar semua kursus yang tersedia.
     *
     * @return \Illuminate\View\View
     */
    public function courses()
    {
        $courses = Course::with('mentor.user')->paginate(10);
        $userCourseAccesses = Auth::user()->courseAccesses->pluck('course_id')->toArray();

        return view('student.courses.index', compact('courses', 'userCourseAccesses'));
    }

    /**
     * Menampilkan detail kursus.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
  public function showCourse(Course $course)
    {
        $courseAccess = CourseAccess::where('user_id', Auth::id())
                                     ->where('course_id', $course->id)
                                     ->first();

        // Jika siswa belum punya akses atau aksesnya tidak aktif
        if (!$courseAccess || !$courseAccess->is_active) {
            // ... (Logic redirect WhatsApp/Locked)
            $adminWhatsAppLink = 'https://wa.me/6283816927804?text=' . urlencode("Halo admin, saya ingin mengaktifkan kursus '{$course->title}'. ID kursus: {$course->id}, ID user: " . Auth::id());
            return redirect($adminWhatsAppLink);
        }

        $course->load('videos', 'finalAssignments.user', 'chats.user', 'mentor.user');

        // Ambil tugas akhir siswa
        $userAssignment = FinalAssignment::where('user_id', Auth::id())
                                          ->where('course_id', $course->id)
                                          ->first();
        
        // --- LOGIC BARU ---
        // Tentukan apakah kursus sudah selesai dan sertifikat siap
        $isCourseCompleted = $userAssignment && ($userAssignment->status === 'certificate_ready');
        // ------------------

        return view('student.courses.show', compact('course', 'userAssignment', 'isCourseCompleted'));
        // Pastikan Anda melewatkan 'isCourseCompleted' ke view
    }
    /**
     * Menampilkan video kursus.
     *
     * @param  \App\Models\Course  $course
     * @param  \App\Models\CourseVideo  $video
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function showVideo(Course $course, CourseVideo $video)
    {
        // Pastikan video ini adalah bagian dari kursus yang benar
        if ($video->course_id !== $course->id) {
            abort(404);
        }

        $courseAccess = CourseAccess::where('user_id', Auth::id())
                                    ->where('course_id', $course->id)
                                    ->where('is_active', true)
                                    ->first();

        if (!$courseAccess) {
            // Redirect ke halaman pembayaran atau notifikasi WhatsApp admin
            $adminWhatsAppLink = 'https://wa.me/6281234567890?text=' . urlencode("Halo admin, saya ingin mengaktifkan kursus '{$course->title}'. ID kursus: {$course->id}, ID user: " . Auth::id());
            return redirect($adminWhatsAppLink);
        }

        return view('student.courses.video', compact('course', 'video'));
    }

    /**
     * Mengunggah tugas akhir untuk kursus.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\RedirectResponse
     */
public function submitAssignment(Request $request, Course $course)
{
    // Cek Akses Kursus (TIDAK BERUBAH)
    $courseAccess = CourseAccess::where('user_id', Auth::id())
                                 ->where('course_id', $course->id)
                                 ->where('is_active', true)
                                 ->first();

    if (!$courseAccess) {
        return back()->with('error', 'Anda tidak memiliki akses aktif ke kursus ini.');
    }

    // Cek apakah sudah pernah submit tugas
    $existingAssignment = FinalAssignment::where('user_id', Auth::id())
                                         ->where('course_id', $course->id)
                                         ->first();
                                         
    // --- LOGIC PENOLAKAN SUBMIT: FINAL/CERTIFICATE READY ---
    if ($existingAssignment && $existingAssignment->status === 'certificate_ready') {
        return back()->with('error', 'Kursus ini sudah selesai dan sertifikat sudah siap/diunggah. Anda tidak dapat mengirimkan tugas lagi.');
    }
    // --------------------------------------------------------

    // --- LAKUKAN VALIDASI HANYA SEKALI DI SINI ---
    $request->validate([
        'assignment_file' => 'required|file|max:10240', // Max 10MB
    ]);
    // ---------------------------------------------

    $filePath = null;
    if ($request->hasFile('assignment_file')) {
        // Upload ke local storage
        $filePath = $request->file('assignment_file')->store('final_assignments', 'public');
    }

    if ($existingAssignment) {
        // Update tugas yang sudah ada
        // Hapus file lama dari storage jika ada
        if ($existingAssignment->file_path && Storage::disk('public')->exists($existingAssignment->file_path)) {
            // Pastikan Anda hanya menghapus file jika file_path baru berbeda dari yang lama
            // (Walaupun dalam kasus upload, file_path baru pasti ada)
            Storage::disk('public')->delete($existingAssignment->file_path);
        }

        $existingAssignment->update([
            'file_path' => $filePath,
            'mentor_id' => $course->mentor_id, 
            'mentor_feedback' => null, // Reset feedback
            'status' => 'pending', // Ubah status menjadi pending lagi
        ]);
        $message = 'Tugas akhir berhasil diperbarui dan dikirim ulang.';
    } else {
        // Buat tugas baru
        FinalAssignment::create([
            'user_id' => Auth::id(),
            'course_id' => $course->id,
            'mentor_id' => $course->mentor_id, 
            'file_path' => $filePath,
            'status' => 'pending',
        ]);
        $message = 'Tugas akhir berhasil dikirim.';
    }

    return redirect()->route('student.courses.show', $course)->with('success', $message);
}
    /**
     * Menampilkan daftar sertifikat yang dimiliki siswa.
     *
     * @return \Illuminate\View\View
     */
    public function certificates()
    {
        $certificates = Auth::user()->certificates()->with('course')->paginate(10);
        return view('student.certificates.index', compact('certificates'));
    }

    /**
     * Mengunduh sertifikat.
     *
     * @param  \App\Models\Certificate  $certificate
     * @return \Symfony\Component\HttpFoundation\StreamedResponse|\Illuminate\Http\RedirectResponse
     */
    public function downloadCertificate(Certificate $certificate)
    {
        if ($certificate->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses ke sertifikat ini.');
        }

        // Cek status tugas akhir terkait
        $assignment = FinalAssignment::where('user_id', Auth::id())
                                     ->where('course_id', $certificate->course_id)
                                     ->first();

        // Cek apakah status tugas sudah 'certificate_ready'
        if (!$assignment || $assignment->status !== 'certificate_ready') {
            return back()->with('error', 'Sertifikat belum siap untuk diunduh. Harap tunggu mentor mengunggah file.');
        }

        // Asumsi certificate_path menyimpan path di storage Laravel
        if ($certificate->certificate_path && Storage::disk('public')->exists($certificate->certificate_path)) {
            // Ubah ekstensi file jika perlu, tapi kita asumsikan file yang disimpan adalah PNG/JPG
            $extension = pathinfo($certificate->certificate_path, PATHINFO_EXTENSION);
            $fileName = 'Sertifikat_' . $certificate->course->title . '_' . $certificate->user->name . '.' . $extension;
            
            return Storage::disk('public')->download($certificate->certificate_path, $fileName);
        }

        return back()->with('error', 'Sertifikat tidak ditemukan atau tidak dapat diunduh.');
    }

    public function downloadMaterial(Course $course, CourseVideo $video)
    {
        // 1. Guard: Pastikan video milik kursus yang benar
        if ($video->course_id !== $course->id) {
            abort(404);
        }

        // 2. Guard: Pastikan siswa memiliki akses aktif ke kursus
        $courseAccess = CourseAccess::where('user_id', Auth::id())
                                    ->where('course_id', $course->id)
                                    ->where('is_active', true)
                                    ->first();

        if (!$courseAccess) {
            return back()->with('error', 'Anda tidak memiliki akses aktif ke kursus ini.');
        }

        // 3. Cek apakah ada material_url
        if (!$video->material_url || !Storage::disk('public')->exists($video->material_url)) {
            return back()->with('error', 'File materi tidak ditemukan.');
        }

        // 4. Proses Download
        $path = $video->material_url;
        
        // Ambil nama file asli (atau buat nama file yang bersih)
        $extension = pathinfo($path, PATHINFO_EXTENSION);
        $fileName = 'Materi_' . $video->title . '.' . $extension;
        
        // Ganti karakter yang tidak aman untuk nama file (misalnya strip)
        $fileName = str_replace([' ', '/', '\\'], '_', $fileName); 

        return Storage::disk('public')->download($path, $fileName);
    }
}
