<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\Obat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    public function index()
    {
        $obats=Obat::all()->sortBy('nama_obat'); // all untuk mengambil semua data obat dan sortBy untuk mengurutkan berdasarkan nama obat
        return view('dokter.obat.index', compact('obats'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'kemasan' => 'required|string|max:50',
            'harga' => 'required|numeric|min:0',
        ]);

        Obat::create($request->all());

        return redirect()->route('dokter.obat.index')->with('success', 'Obat berhasil ditambahkan.');
    }
    public function update(Request $request, $id)
    {
        $obat = Obat::findOrFail($id);

        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'kemasan' => 'required|string|max:50',
            'harga' => 'required|numeric|min:0',
        ]);

        $obat->update($request->all());

        return redirect()->route('dokter.obat.index')->with('success', 'Obat berhasil diperbarui.');
    }
    public function destroy($id)
    {
        $obat = Obat::findOrFail($id);
        $obat->delete();

        return redirect()->route('dokter.obat.index')->with('success', 'Obat berhasil dihapus.');
    }
}
