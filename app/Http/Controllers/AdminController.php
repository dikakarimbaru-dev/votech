<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Vote;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        $total_suara = Vote::count();
        $total_siswa = User::where('role', 'voter')->count();
        $candidates = Candidate::withCount('votes')->get();
        $recent_votes = User::where('status_pilih', true)
                            ->orderBy('updated_at', 'desc')
                            ->take(5)
                            ->get();

        return view('admin.dashboard', compact('total_suara', 'total_siswa', 'candidates', 'recent_votes'));
    }

    public function candidates()
    {
        $candidates = Candidate::orderBy('nomor_urut', 'asc')->get();
        return view('admin.candidates.index', compact('candidates'));
    }

    public function create()
    {
        return view('admin.candidates.form');
    }

    public function store(Request $request)
{
   $request->validate([
    'nama_ketua' => 'required|string|max:255',
    'nama_wakil' => 'required|string|max:255',
    'nomor_urut' => 'required|integer|unique:candidates,nomor_urut',
    'foto'       => 'required|image|mimes:jpeg,png,jpg,webp|max:2048', 
    'visi'       => 'required',
    'misi'       => 'required',
]);

    // LOGIC PENYELAMAT: Pastikan folder tujuan ada
    if (!Storage::disk('public')->exists('candidates')) {
        Storage::disk('public')->makeDirectory('candidates');
    }

    if ($request->hasFile('foto')) {
        // Gunakan storePublicly agar file langsung bisa diakses publik
        $path = $request->file('foto')->store('candidates', 'public');
        
        Candidate::create([
            'nama_ketua' => $request->nama_ketua,
            'nama_wakil' => $request->nama_wakil,
            'nomor_urut' => $request->nomor_urut,
            'visi'       => $request->visi,
            'misi'       => $request->misi,
            'foto'       => $path,
        ]);

        return redirect()->route('admin.candidates.index')->with('success', 'Kandidat Berhasil Masuk Database!');
    }

    return back()->withInput()->withErrors(['foto' => 'File foto tidak terdeteksi oleh sistem.']);
}

    // Fitur Edit & Update DIHAPUS untuk integritas data sesuai permintaan user

    public function destroy($id)
    {
        $candidate = Candidate::findOrFail($id);
        if ($candidate->foto) {
            Storage::disk('public')->delete($candidate->foto);
        }
        $candidate->delete();

        return back()->with('success', 'Kandidat Berhasil Dihapus!');
    }
}    