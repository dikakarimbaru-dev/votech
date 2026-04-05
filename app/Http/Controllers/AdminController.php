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
            'nomor_urut' => 'required|integer|unique:candidates',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'visi' => 'required',
            'misi' => 'required',
        ]);

        $path = null;
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('candidates', 'public');
        }

        Candidate::create([
            'nama_ketua' => $request->nama_ketua,
            'nama_wakil' => $request->nama_wakil,
            'nomor_urut' => $request->nomor_urut,
            'visi' => $request->visi,
            'misi' => $request->misi,
            'foto' => $path,
        ]);

        return redirect()->route('admin.candidates.index')->with('success', 'Kandidat berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $candidate = Candidate::findOrFail($id);
        return view('admin.candidates.form', compact('candidate'));
    }

    public function update(Request $request, $id)
    {
        $candidate = Candidate::findOrFail($id);
        
        $request->validate([
            'nama_ketua' => 'required|string|max:255',
            'nama_wakil' => 'required|string|max:255',
            'nomor_urut' => 'required|integer|unique:candidates,nomor_urut,'.$id,
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'visi' => 'required',
            'misi' => 'required',
        ]);

        $data = $request->only(['nama_ketua', 'nama_wakil', 'nomor_urut', 'visi', 'misi']);

        if ($request->hasFile('foto')) {
            if ($candidate->foto) Storage::disk('public')->delete($candidate->foto);
            $data['foto'] = $request->file('foto')->store('candidates', 'public');
        }

        $candidate->update($data);

        return redirect()->route('admin.candidates.index')->with('success', 'Data Paslon berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $candidate = Candidate::findOrFail($id);
        if ($candidate->foto) {
            Storage::disk('public')->delete($candidate->foto);
        }
        $candidate->delete();

        return back()->with('success', 'Kandidat berhasil dihapus!');
    }
}