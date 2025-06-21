<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $poli = [
            'Penyakit Dalam',
            'Anak',
            'Kebidanan dan Kandungan',
            'Mata',
            'THT'
        ];
        return view('profile.edit', [
            'user' => $request->user(),
            'poli' => $poli,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama'    => 'required|string|max:255',
            'poli'    => 'nullable|string|max:255',
            'no_ktp'  => 'required|string|max:20',
            'no_hp'   => 'required|string|max:20',
            'alamat'  => 'required|string|max:255',
        ]);

        // Ambil user yang sedang login
        $user = $request->user();

        // Update data
        $user->nama   = $request->nama;
        $user->poli   = $request->poli;
        $user->no_ktp = $request->no_ktp;
        $user->no_hp  = $request->no_hp;
        $user->alamat = $request->alamat;

        $user->save(); // simpan perubahan

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
