<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Obat;

class ObatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // obat field->nama_obat, kemasan, harga
        $obats= [
            ['nama_obat' => 'Paracetamol', 'kemasan' => 'Tablet', 'harga' => 5000],
            ['nama_obat' => 'Amoxicillin', 'kemasan' => 'Kapsul', 'harga' => 10000],
            ['nama_obat' => 'Ibuprofen', 'kemasan' => 'Tablet', 'harga' => 7000],
            ['nama_obat' => 'Cetirizine', 'kemasan' => 'Sirup', 'harga' => 8000],
            ['nama_obat' => 'Omeprazole', 'kemasan' => 'Tablet', 'harga' => 12000],
        ];
        foreach ($obats as $obat) {
            Obat::create($obat);
        }
    }
}
