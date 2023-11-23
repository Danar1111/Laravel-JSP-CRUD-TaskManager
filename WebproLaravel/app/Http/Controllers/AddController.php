<?php

namespace App\Http\Controllers;

use App\Models\task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AddController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('add');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('home');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi data jika diperlukan
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'nullable|string|max:255',
            'due_date' => 'required',
            'priority' => 'required|in:urgent,finish_him,chill',
        ]);

        // Dapatkan user ID dari pengguna yang sedang login
        $userId = Auth::id();

        // Simpan data ke dalam tabel tasks hanya jika user ID valid
        if ($userId) {
            $task = Task::create([
                'user_id' => $userId,
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'category' => $request->input('category'),
                'due_date' => $request->input('due_date'),
                'priority' => $request->input('priority'),
            ]);

            // Redirect ke halaman sukses jika tugas berhasil dibuat
            return redirect('/home')->with('success', 'Task created successfully!');
        }

        // Redirect dengan pesan kesalahan jika user ID tidak valid
        return redirect('/home')->with('error', 'Unauthorized task creation attempt!');
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
        $data = task::where('title', $id)->first();
        return view('edit')->with('data', $data);
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
        // Dapatkan user ID dari pengguna yang sedang login
        $userId = Auth::id();

        // Temukan tugas berdasarkan ID dan pastikan tugas tersebut dimiliki oleh pengguna yang sedang login
        $task = Task::where('user_id', $userId)->where('title', $id)->first();

        // Memeriksa apakah tugas ditemukan
        if ($task) {
            // Validasi data jika diperlukan
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'category' => 'nullable|string|max:255',
                'due_date' => 'required',
                'priority' => 'required|in:urgent,finish_him,chill',
            ]);

            // Simpan data ke dalam tabel tasks
            $task->update([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'category' => $request->input('category'),
                'due_date' => $request->input('due_date'),
                'priority' => $request->input('priority'),
            ]);

            // Redirect ke halaman sukses atau halaman lainnya
            return redirect('/home')->with('success', 'Task updated successfully!');
        }

        // Redirect dengan pesan kesalahan jika tugas tidak ditemukan atau tidak dimiliki oleh pengguna yang sedang login
        return redirect('/home')->with('error', 'Task not found or unauthorized update attempt!');
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
        $task = Task::where('user_id', Auth::id())->where('title', $id)->first();

        // Memeriksa apakah tugas ditemukan
        if ($task) {
            // Menghapus tugas jika ditemukan
            $task->delete();
            return redirect('/home')->with('success', 'Task deleted successfully!');
        }

        // Mengembalikan jika tugas tidak ditemukan atau tidak terkait dengan pengguna yang sedang login
        return redirect('/home')->with('error', 'Task not found or unauthorized deletion attempt!');
    }
}
