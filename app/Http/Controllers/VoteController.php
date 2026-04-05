<?php

namespace App\Http\Controllers;

use App\Models\Candidate; // Panggil Model Candidate
use App\Models\Vote;      // Panggil Model Vote
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Untuk ambil data user login

class VoteController extends Controller
{
    public function index()
    {
        $candidates = Candidate::orderBy('nomor_urut', 'asc')->get();
        return view('dashboard', compact('candidates'));
    }

    public function castVote(Request $request, $id)
    {
        $user = Auth::user(); // Ambil data siswa yang sedang login

        // Proteksi: Jika sudah memilih, tendang balik
        if ($user->status_pilih) {
            return back()->with('error', 'Anda sudah menggunakan hak suara!');
        }

        // Simpan suara ke tabel votes
        Vote::create([
            'candidate_id' => $id
        ]);

        // Kunci status user agar tidak bisa milih lagi
        $user->status_pilih = true;
        $user->save();

        return redirect()->route('dashboard')->with('success', 'Suara berhasil dikirim!');
    }
}