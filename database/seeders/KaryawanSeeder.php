<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use Carbon\Carbon;

class KaryawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        // Hapus data dummy sebelumnya jika diperlukan, tapi kita biarkan saja nambah

        $genders = [
            ['jenis' => 'pria', 'count' => 10],
            ['jenis' => 'wanita', 'count' => 10],
        ];

        foreach ($genders as $gender) {
            for ($i = 0; $i < $gender['count']; $i++) {
                
                // Tentukan gender Faker
                $fakerGender = $gender['jenis'] == 'pria' ? 'male' : 'female';
                
                $email = $faker->unique()->safeEmail;
                
                // 1. Insert Karyawan
                DB::table('karyawan')->insert([
                    'nip' => $faker->numerify('##########'),
                    'nama' => $faker->name($fakerGender),
                    'email' => $email,
                    'jenkel' => $gender['jenis'],
                    'password' => Hash::make('password123'),
                    'referensi' => '2',
                    'referensi_detail' => 'Dari Teman',
                    'status' => '1', // Langsung terverifikasi agar muncul di list taaruf
                    'email_verification_token' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // 2. Insert Biodata
                DB::table('biodata')->insert([
                    'email' => $email,
                    'tempatlahir' => substr($faker->city, 0, 25),
                    'tgllahir' => $faker->dateTimeBetween('-35 years', '-20 years')->format('Y-m-d'),
                    'goldar' => $faker->randomElement(['A', 'B', 'AB', 'O']),
                    'statusnikah' => $faker->randomElement(['Lajang', 'Duda/Janda']),
                    'pekerjaan' => substr($faker->jobTitle, 0, 25),
                    'suku' => $faker->randomElement(['Jawa', 'Sunda', 'Batak', 'Minang', 'Bugis']),
                    'pendidikan' => $faker->randomElement(['S1', 'S2', 'D3', 'SMA']),
                    'hobi' => 'Membaca, Olahraga, dan Traveling',
                    'motto' => 'Sebaik-baik manusia adalah yang bermanfaat bagi orang lain',
                    'nohp' => $faker->numerify('08##########'),
                    'alamat' => $faker->address,
                    'tinggi' => $faker->numberBetween(150, 180),
                    'berat' => $faker->numberBetween(45, 80),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // 3. Insert Kriteria Pasangan
                DB::table('kriteriapasangan')->insert([
                    'email' => $email,
                    'kriteriaumur' => '20 - 35',
                    'kriteriatinggi' => '150 - 180',
                    'kriteriaberat' => '45 - 75',
                    'kriteriaumum' => 'Seiman, sholeh/sholehah, pekerja keras, dan penyayang keluarga.',
                    'kriteriasuku' => 'Tidak masalah',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
