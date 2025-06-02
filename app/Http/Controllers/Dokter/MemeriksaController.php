<?php

namespace App\Http\Controllers\Dokter;

use App\Models\JadwalPeriksa;
use App\Models\JanjiPeriksa;
use App\Models\Obat;
use App\Models\Periksa;
use App\Models\DetailPeriksa;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MemeriksaController extends Controller
{
    public function index()
    {
        $jadwalPeriksa = JadwalPeriksa::where(
            'id_dokter',
            Auth::user()->id
        )
            ->where('status', true)
            ->first();
        $janjiPeriksas = JanjiPeriksa::where(
            'id_jadwal_periksa',
            $jadwalPeriksa->id
        )
            ->with(['pasien', 'jadwalPeriksa'])
            ->get();
        $obats = Obat::all();
        return view('dokter.memeriksa.index')->with([
            'janjiPeriksas' => $janjiPeriksas,
            'obats' => $obats,
        ]);
    }
    public function edit($id)
    {
        $janjiPeriksa = JanjiPeriksa::findOrFail($id);
        $obats = Obat::all();
        return view('dokter.memeriksa.edit')->with([
            'janjiPeriksa' => $janjiPeriksa,
            'obats' => $obats,
        ]);
    }
    public function periksa($id)
    {
        $janjiPeriksa = JanjiPeriksa::findOrFail($id);
        $obats = Obat::all();
        return view('dokter.memeriksa.periksa')->with([
            'janjiPeriksa' => $janjiPeriksa,
            'obats' => $obats,
        ]);
    }
    // public function storeWithId(Request $request, $id)
    // {
    //     $request->validate([
    //         'tgl_periksa' => 'required|date',
    //         'catatan' => 'required|string',
    //         'obat' => 'required|string',
    //         'biaya_periksa' => 'required|numeric',
    //     ]);
    //     $janjiPeriksa = JanjiPeriksa::findOrFail($id);
    //     $periksa = Periksa::create([
    //         'id_janji_periksa' => $janjiPeriksa->id,
    //         'tgl_periksa' => $request->tgl_periksa,
    //         'catatan' => $request->catatan,
    //         'biaya_periksa' => $request->biaya_periksa,
    //     ]);
    //     return
    //         redirect()->route('dokter.memeriksa.index')->with(
    //             'status',
    //             'memeriksa-created'
    //         );
    // }
    public function update(Request $request, $id)
    {
        $request->validate([
            'tgl_periksa' => 'required|date',
            'catatan' => 'required|string',
            'obat' => 'required|string',
            'biaya_periksa' => 'required|numeric',
        ]);
        // Temukan data pemeriksaan yang akan diupdate
        $periksa = Periksa::findOrFail($id);
        // Update data pemeriksaan
        $periksa->update([
            'tgl_periksa' => $request->tgl_periksa,
            'catatan' => $request->catatan,
            'biaya_periksa' => $request->biaya_periksa,
        ]);
        // Hapus detail obat yang lama
        DetailPeriksa::where(
            'id_periksa',
            $periksa->id
        )->delete();
        return
            redirect()->route('dokter.memeriksa.index')->with(
                'status',
                'memeriksa-updated'
            );
    }
}
