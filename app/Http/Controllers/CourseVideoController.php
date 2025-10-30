<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CourseVideoController extends Controller
{
    /**
     * Menampilkan form untuk membuat video baru.
     */
    public function create(Course $course)
    {
        // Guard: Pastikan mentor yang login adalah mentor yang memiliki kursus ini
        if ($course->mentor_id !== Auth::user()->mentor->id) {
            abort(403, 'Anda tidak memiliki akses untuk menambah video ke kursus ini.');
        }
        return view('mentor.courses.videos.create', compact('course'));
    }

    /**
     * Menyimpan video dan materi baru.
     */
    public function store(Request $request, Course $course)
    {
        // 1. Validasi Input
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            // Max 50MB
            'material_file' => 'nullable|file|max:50000|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,txt',
            // Max 500MB
            'video_file' => 'required|file|max:500000|mimes:mp4,mov,avi,wmv',
        ]);

        $videoPath = null;
        $materialPath = null;

        // 2. Upload File Video
        if ($request->hasFile('video_file')) {
            // Simpan video ke 'public/course_videos'
            $videoPath = $request->file('video_file')->store('course_videos', 'public');
        }

        // 3. Upload File Materi (Opsional)
        if ($request->hasFile('material_file')) {
            // Simpan materi ke 'public/course_materials'
            $materialPath = $request->file('material_file')->store('course_materials', 'public');
        }

        // 4. Simpan Data ke Database
        CourseVideo::create([
            'course_id' => $course->id,
            'title' => $request->title,
            'description' => $request->description,
            'cloudinary_url' => $videoPath, // Menggunakan kolom ini untuk path file video
            'material_url' => $materialPath, // Kolom untuk path file materi
            // Anda mungkin perlu menambahkan kolom 'sort_order' atau 'duration' jika ada
        ]);

        // 5. Kembalikan Respons JSON (Wajib untuk AJAX Progress Bar)
        return response()->json([
            'message' => 'Video dan materi berhasil diunggah dan disimpan.',
            'redirect_url' => route('mentor.courses.show', $course),
        ], 201);
    }

    /**
     * Menampilkan form untuk mengedit video.
     */
    public function edit(CourseVideo $courseVideo)
    {
        // Guard
        if ($courseVideo->course->mentor_id !== Auth::user()->mentor->id) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit video ini.');
        }
        return view('mentor.courses.videos.edit', compact('courseVideo'));
    }

    /**
     * Memperbarui video dan materi.
     */
    public function update(Request $request, CourseVideo $courseVideo)
    {
        // 1. Validasi Input (Ubah 'required' menjadi 'nullable' untuk file)
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'material_file' => 'nullable|file|max:50000|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,txt', // Opsional saat update
            'video_file' => 'nullable|file|max:500000|mimes:mp4,mov,avi,wmv', // Opsional saat update
            'remove_material' => 'nullable|boolean', // Untuk menghapus materi
        ]);

        $data = $request->only(['title', 'description']);

        // 2. Update File Materi
        if ($request->hasFile('material_file')) {
            // Hapus file lama jika ada
            if ($courseVideo->material_url) {
                Storage::disk('public')->delete($courseVideo->material_url);
            }
            // Simpan file baru
            $data['material_url'] = $request->file('material_file')->store('course_materials', 'public');
        } elseif ($request->has('remove_material') && $courseVideo->material_url) {
            // Hapus materi jika checkbox di centang
            Storage::disk('public')->delete($courseVideo->material_url);
            $data['material_url'] = null;
        }

        // 3. Update File Video
        if ($request->hasFile('video_file')) {
            // Hapus file lama jika ada
            if ($courseVideo->cloudinary_url) {
                Storage::disk('public')->delete($courseVideo->cloudinary_url);
            }
            // Simpan file baru
            $data['cloudinary_url'] = $request->file('video_file')->store('course_videos', 'public');
        }

        // 4. Simpan Data ke Database
        $courseVideo->update($data);

        // 5. Kembalikan Respons JSON (Wajib untuk AJAX Progress Bar)
        return response()->json([
            'message' => 'Video dan materi berhasil diupdate.',
            'redirect_url' => route('mentor.courses.show', $courseVideo->course),
        ], 200);
    }

    /**
     * Menghapus video dan materi.
     */
    public function destroy(CourseVideo $courseVideo)
    {
        // Guard
        if ($courseVideo->course->mentor_id !== Auth::user()->mentor->id) {
            abort(403, 'Anda tidak memiliki akses untuk menghapus video ini.');
        }

        // Hapus video dari storage
        if ($courseVideo->cloudinary_url && Storage::disk('public')->exists($courseVideo->cloudinary_url)) {
            Storage::disk('public')->delete($courseVideo->cloudinary_url);
        }

        // Hapus materi dari storage
        if ($courseVideo->material_url && Storage::disk('public')->exists($courseVideo->material_url)) {
            Storage::disk('public')->delete($courseVideo->material_url);
        }

        $courseVideo->delete();

        return redirect()->route('mentor.courses.show', $courseVideo->course)->with('success', 'Video dan materi berhasil dihapus.');
    }
}
