<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseChat;
use App\Models\FinalAssignment;
use App\Models\MentorChat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
   
    // --- Chat dalam Kursus (Siswa dan Mentor) ---

    /**
     * Menampilkan chat untuk kursus tertentu.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\View\View
     */
    public function showCourseChat(Course $course)
    {
        // Pastikan pengguna memiliki akses ke kursus ini
        $user = Auth::user();
        $hasAccess = false;
        if ($user->role === 'student') {
            $hasAccess = $user->courseAccesses()->where('course_id', $course->id)->where('is_active', true)->exists();
        } elseif ($user->role === 'mentor') {
            $hasAccess = $course->mentor_id === $user->mentor->id;
        } elseif ($user->role === 'admin') {
            $hasAccess = true; // Admin selalu bisa melihat chat kursus
        }

        if (!$hasAccess) {
            abort(403, 'Anda tidak memiliki akses ke chat kursus ini.');
        }

        $chats = CourseChat::where('course_id', $course->id)->with('user')->latest()->get();
        return view('chats.course_chat', compact('course', 'chats'));
    }

    /**
     * Mengirim pesan dalam chat kursus.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendCourseChatMessage(Request $request, Course $course)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        $user = Auth::user();
        $hasAccess = false;
        if ($user->role === 'student') {
            $hasAccess = $user->courseAccesses()->where('course_id', $course->id)->where('is_active', true)->exists();
        } elseif ($user->role === 'mentor') {
            $hasAccess = $course->mentor_id === $user->mentor->id;
        }

        if (!$hasAccess) {
            abort(403, 'Anda tidak memiliki akses untuk mengirim pesan di chat kursus ini.');
        }

        CourseChat::create([
            'course_id' => $course->id,
            'user_id' => Auth::id(),
            'message' => $request->message,
        ]);

        return back()->with('success', 'Pesan berhasil dikirim.');
    }

    // --- Chat Personal Mentor-Siswa ---

    /**
     * Menampilkan daftar chat mentor-siswa untuk pengguna yang login.
     * (Siswa akan melihat chat dengan mentornya, mentor akan melihat chat dengan siswanya)
     *
     * @return \Illuminate\View\View
     */
    public function showMentorChats()
    {
        $user = Auth::user();
        $chats = collect();

        if ($user->role === 'student') {
            // Siswa melihat chat yang dikirim atau diterima
            $chats = MentorChat::where('sender_id', $user->id)
                               ->orWhere('receiver_id', $user->id)
                               ->with('sender', 'receiver')
                               ->orderBy('created_at', 'desc')
                               ->get()
                               ->groupBy(function ($chat) use ($user) {
                                   return $chat->sender_id === $user->id ? $chat->receiver_id : $chat->sender_id;
                               });
            $chats = $chats->map(function ($groupedChats) {
                return $groupedChats->first(); // Ambil pesan terbaru dari setiap percakapan
            });
        } elseif ($user->role === 'mentor') {
            // Mentor melihat chat dengan siswa yang memiliki tugas dengannya
            $mentor = $user->mentor;
            $studentsWithAssignments = $mentor->finalAssignments()
                                            ->with('user')
                                            ->distinct('user_id')
                                            ->get()
                                            ->pluck('user');

            $chats = collect();
            foreach ($studentsWithAssignments as $student) {
                $latestChat = MentorChat::where(function ($query) use ($user, $student) {
                                    $query->where('sender_id', $user->id)->where('receiver_id', $student->id);
                                })->orWhere(function ($query) use ($user, $student) {
                                    $query->where('sender_id', $student->id)->where('receiver_id', $user->id);
                                })
                                ->latest()
                                ->first();
                if ($latestChat) {
                    $chats->push($latestChat);
                }
            }
        }
        // Admin tidak punya chat personal secara default

        return view('chats.mentor_chats.index', compact('chats'));
    }

    /**
     * Menampilkan detail percakapan chat mentor-siswa.
     *
     * @param  \App\Models\User  $otherUser (mentor jika user siswa, siswa jika user mentor)
     * @return \Illuminate\View\View
     */
    public function showMentorChatDetail(User $otherUser)
    {
        $user = Auth::user();

        // Pastikan pengguna yang login adalah siswa atau mentor
        if (!in_array($user->role, ['student', 'mentor'])) {
            abort(403, 'Anda tidak memiliki akses ke fitur chat personal.');
        }

        // Pastikan pengguna yang diajak chat adalah siswa atau mentor yang valid
        if (!in_array($otherUser->role, ['student', 'mentor'])) {
            abort(403, 'Pengguna ini tidak dapat diajak chat personal.');
        }

        // Logika otorisasi
        if ($user->role === 'student' && $otherUser->role === 'mentor') {
            // Siswa hanya bisa chat dengan mentor dari kursus yang dia ikuti
            $hasCommonCourse = $user->courseAccesses()
                                    ->where('is_active', true)
                                    ->whereHas('course', function ($q) use ($otherUser) {
                                        $q->where('mentor_id', $otherUser->mentor->id);
                                    })
                                    ->exists();
            if (!$hasCommonCourse) {
                abort(403, 'Anda hanya dapat chat dengan mentor dari kursus yang Anda ikuti.');
            }
        } elseif ($user->role === 'mentor' && $otherUser->role === 'student') {
            // Mentor hanya bisa chat dengan siswa yang memiliki tugas dengannya
            $hasAssignment = FinalAssignment::where('mentor_id', $user->mentor->id)
                                            ->where('user_id', $otherUser->id)
                                            ->exists();
            if (!$hasAssignment) {
                abort(403, 'Anda hanya dapat chat dengan siswa yang memiliki tugas di bawah Anda.');
            }
        } else {
            abort(403, 'Tidak diizinkan untuk chat personal antara peran ini.');
        }


        $messages = MentorChat::where(function ($query) use ($user, $otherUser) {
                                    $query->where('sender_id', $user->id)
                                          ->where('receiver_id', $otherUser->id);
                                })
                               ->orWhere(function ($query) use ($user, $otherUser) {
                                    $query->where('sender_id', $otherUser->id)
                                          ->where('receiver_id', $user->id);
                                })
                               ->orderBy('created_at', 'asc')
                               ->get();

        return view('chats.mentor_chats.show', compact('otherUser', 'messages'));
    }

    /**
     * Mengirim pesan dalam chat mentor-siswa.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $receiver (pengguna yang menerima pesan)
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendMentorChatMessage(Request $request, User $receiver)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        $user = Auth::user();

        // Logika otorisasi (duplikasi dari showMentorChatDetail untuk keamanan)
        if ($user->role === 'student' && $receiver->role === 'mentor') {
            $hasCommonCourse = $user->courseAccesses()
                                    ->where('is_active', true)
                                    ->whereHas('course', function ($q) use ($receiver) {
                                        $q->where('mentor_id', $receiver->mentor->id);
                                    })
                                    ->exists();
            if (!$hasCommonCourse) {
                abort(403, 'Anda hanya dapat mengirim pesan ke mentor dari kursus yang Anda ikuti.');
            }
        } elseif ($user->role === 'mentor' && $receiver->role === 'student') {
            $hasAssignment = FinalAssignment::where('mentor_id', $user->mentor->id)
                                            ->where('user_id', $receiver->id)
                                            ->exists();
            if (!$hasAssignment) {
                abort(403, 'Anda hanya dapat mengirim pesan ke siswa yang memiliki tugas di bawah Anda.');
            }
        } else {
            abort(403, 'Tidak diizinkan untuk mengirim pesan personal antara peran ini.');
        }

        MentorChat::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $receiver->id,
            'message' => $request->message,
        ]);

        return back()->with('success', 'Pesan berhasil dikirim.');
    }
}
