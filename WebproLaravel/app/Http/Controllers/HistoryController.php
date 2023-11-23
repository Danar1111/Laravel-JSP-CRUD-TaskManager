<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
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
        $tasksQuery = History::where('user_id', $userId);

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

        // Mengurutkan berdasarkan done_at secara ascending dan membuat pagination
        $data = $tasksQuery->orderBy('done_at', 'asc')->paginate(10);

        return view('history')->with('data', $data);
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
        // Mengambil tugas berdasarkan ID, memastikan tugas terkait dengan pengguna yang sedang login
        $task = History::where('user_id', Auth::id())->where('title', $id)->first();

        // Memeriksa apakah tugas ditemukan
        if ($task) {
            // Menghapus tugas jika ditemukan
            $task->delete();
            return redirect('/history')->with('success', 'Task History deleted successfully!');
        }

        // Mengembalikan jika tugas tidak ditemukan atau tidak terkait dengan pengguna yang sedang login
        return redirect('/history')->with('error', 'Task not found or unauthorized deletion attempt!');
    }
}
