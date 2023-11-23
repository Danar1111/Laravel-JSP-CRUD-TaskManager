<?php

namespace App\Http\Controllers;

use App\Mail\RekapTugasMail;
use App\Models\History;
use App\Models\task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $katakunci = $request->katakunci;
        $pr = $request->pr;
        $userId = Auth::id();

        // Menggunakan relasi tasks() untuk mendapatkan tugas milik pengguna yang sedang login
        $tasksQuery = Task::where('user_id', $userId);

        // Menerapkan filter jika ada kata kunci pencarian
        if (strlen($katakunci)) {
            $tasksQuery->where(function ($query) use ($katakunci) {
                $query->where('title', 'like', "%$katakunci%")
                    ->orWhere('description', 'like', "%$katakunci%")
                    ->orWhere('category', 'like', "%$katakunci%")
                    ->orWhere('due_date', 'like', "%$katakunci%")
                    ->orWhere('priority', 'like', "%$katakunci%");
            });
        }elseif (strlen($pr)) {
            $tasksQuery->where('priority', 'like', "%$pr%");
        }

        // Mengurutkan berdasarkan due_date secara ascending dan membuat pagination
        $data = $tasksQuery->orderBy('due_date', 'asc')->paginate(10);

        return view('home')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function done($id)
    {
        // Temukan tugas berdasarkan ID
        $task = Task::findOrFail($id);

        // Pindahkan tugas yang sudah selesai ke dalam tabel history
        History::create([
            'user_id' => $task->user_id,
            'title' => $task->title,
            'description' => $task->description,
            'category' => $task->category,
            'due_date' => $task->due_date,
            'priority' => $task->priority,
            'done_at' => now(), // Tambahkan waktu selesai
        ]);

        // Hapus tugas dari tabel tasks
        $task->delete();

        // Redirect ke halaman lain atau beri respons JSON jika Anda menggunakan API
        return redirect('/home')->with('success', 'Task marked as done and moved to history successfully!');
    }

    public function recap(Request $request)
    {
        // Mengumpulkan data tugas dari database atau sumber data lainnya
        $tasks = Task::where('user_id', $request->user()->id)
                        ->where('due_date', '>', now()) // Memfilter hanya tugas yang deadline-nya belum lewat
                        ->orderBy('due_date', 'asc')
                        ->get();

        // Pastikan ada tugas yang perlu direkap
        if ($tasks->isEmpty()) {
            return redirect('/home')->with('error', 'There are no assignments that need to be recapped.');
        }

        // Kirim email ke user dengan menggunakan Mail facade
        $user = $request->user(); // Mendapatkan data pengguna (user) saat ini
        Mail::to($user->email)->send(new RekapTugasMail($user, $tasks));

        return redirect('/home')->with('success', 'Task recap successfully sent to email!');
    }
}
