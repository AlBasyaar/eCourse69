<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; // Import Storage facade

class CourseVideoController extends Controller
{
   

    /**
     * Menampilkan form untuk membuat video baru.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\View\View
     */
    public function create(Course $course)
    {
        // Pastikan mentor yang login adalah mentor yang memiliki kursus ini
        if ($course->mentor_id !== Auth::user()->mentor->id) {
            abort(403, 'Anda tidak memiliki akses untuk menambah video ke kursus ini.');
        }
        return view('mentor.courses.videos.create', compact('course'));
    }

    /**
     * Menyimpan video baru.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, Course $course)
    {
        // Pastikan mentor yang login adalah mentor yang memiliki kursus ini
        if ($course->mentor_id !== Auth::user()->mentor->id) {
            abort(403, 'Anda tidak memiliki akses untuk menambah video ke kursus ini.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'video_file' => 'required|file|mimes:mp4,mov,avi,wmv|max:512000', // Max 500MB
        ]);

        $filePath = null;
        if ($request->hasFile('video_file')) {
            // Simpan video ke direktori 'public/course_videos'
            // dan dapatkan path relatifnya.
            $filePath = $request->file('video_file')->store('course_videos', 'public');
        }

        CourseVideo::create([
            'course_id' => $course->id,
            'title' => $request->title,
            'description' => $request->description,
            'cloudinary_url' => $filePath, // Menggunakan kolom ini untuk menyimpan path lokal
        ]);

        return redirect()->route('mentor.courses.show', $course)->with('success', 'Video berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit video.
     *
     * @param  \App\Models\CourseVideo  $courseVideo
     * @return \Illuminate\View\View
     */
    public function edit(CourseVideo $courseVideo)
    {
        // Pastikan mentor yang login adalah mentor yang memiliki kursus yang terkait dengan video ini
        if ($courseVideo->course->mentor_id !== Auth::user()->mentor->id) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit video ini.');
        }
        return view('mentor.courses.videos.edit', compact('courseVideo'));
    }

    /**
     * Memperbarui video.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CourseVideo  $courseVideo
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, CourseVideo $courseVideo)
    {
        // Pastikan mentor yang login adalah mentor yang memiliki kursus yang terkait dengan video ini
        if ($courseVideo->course->mentor_id !== Auth::user()->mentor->id) {
            abort(403, 'Anda tidak memiliki akses untuk memperbarui video ini.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'video_file' => 'nullable|file|mimes:mp4,mov,avi,wmv|max:512000', // Max 500MB
        ]);

        $filePath = $courseVideo->cloudinary_url; // Simpan path lama
        if ($request->hasFile('video_file')) {
            // Hapus video lama dari storage jika ada
            if ($courseVideo->cloudinary_url && Storage::disk('public')->exists($courseVideo->cloudinary_url)) {
                Storage::disk('public')->delete($courseVideo->cloudinary_url);
            }
            // Simpan video baru ke direktori 'public/course_videos'
            $filePath = $request->file('video_file')->store('course_videos', 'public');
        }

        $courseVideo->update([
            'title' => $request->title,
            'description' => $request->description,
            'cloudinary_url' => $filePath, // Perbarui dengan path baru
        ]);

        return redirect()->route('mentor.courses.show', $courseVideo->course)->with('success', 'Video berhasil diperbarui.');
    }

    /**
     * Menghapus video.
     *
     * @param  \App\Models\CourseVideo  $courseVideo
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(CourseVideo $courseVideo)
    {
        // Pastikan mentor yang login adalah mentor yang memiliki kursus yang terkait dengan video ini
        if ($courseVideo->course->mentor_id !== Auth::user()->mentor->id) {
            abort(403, 'Anda tidak memiliki akses untuk menghapus video ini.');
        }

        // Hapus video dari storage
        if ($courseVideo->cloudinary_url && Storage::disk('public')->exists($courseVideo->cloudinary_url)) {
            Storage::disk('public')->delete($courseVideo->cloudinary_url);
        }
        $courseVideo->delete();

        return redirect()->route('mentor.courses.show', $courseVideo->course)->with('success', 'Video berhasil dihapus.');
    }
}
