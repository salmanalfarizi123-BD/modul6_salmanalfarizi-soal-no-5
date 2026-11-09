<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PeminjamanController extends Controller
{
  
    public function create()
    {
        $bukus = Buku::all(); 
        return view('siswa.peminjaman-create', compact('bukus'));
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'buku_id' => 'required|exists:bukus,id',
        ]);

        Peminjaman::create([
            'user_id'        => auth()->id(),
            'buku_id'        => $request->buku_id,
            'tanggal_pinjam' => now(), 
            'status'         => 'Pending',
        ]);

        return redirect()->route('siswa.riwayat')->with('success', 'Pengajuan peminjaman buku berhasil dikirim dan menunggu persetujuan petugas.');
    }

    public function index()
    {
        $peminjamans = Peminjaman::with(['user', 'buku'])->latest()->get();
        return view('admin.peminjaman.index', compact('peminjamans'));
    }

    public function updateStatus(Request $request, $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:Pending,Dipinjam,Ditolak,Dikembalikan',
        ]);

        $peminjaman->update(['status' => $request->status]);

        return redirect()->route('admin.peminjaman.index')->with('success', 'Status peminjaman berhasil diperbarui.');
    }

    public function riwayatSiswa()
    {
        $peminjamans = Peminjaman::with('buku')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('siswa.riwayat', compact('peminjamans'));
    }
    public function show($id) {
    $peminjaman = Peminjaman::findOrFail($id);
    
    Gate::authorize('view', $peminjaman);
    return view('peminjaman.show', compact('peminjaman'));
}
}