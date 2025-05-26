<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'nama' => 'Dr. Budi Santoso, Sp.PD',
            'email' => 'budi.santoso@klinik.com',
            'password' => Hash::make('dokter123'),
            'role' => 'dokter',
            'alamat' => 'Jl. Pahlawan No. 123, Jakarta Selatan',
            'no_ktp' => '3175062505800001',
            'no_hp' => '081234567890',
            'poli' => 'Penyakit Dalam',
        ]);
    }
}
