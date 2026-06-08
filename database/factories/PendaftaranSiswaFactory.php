<?php

namespace Database\Factories;

use App\Models\PendaftaranSiswa;
use Illuminate\Database\Eloquent\Factories\Factory;

class PendaftaranSiswaFactory extends Factory
{
    protected $model = PendaftaranSiswa::class;

    public function definition(): array
    {
        return [
            'nama_lengkap' => fake()->name(),
            'nik' => fake()->unique()->numerify('################'),
            'email' => fake()->safeEmail(),
            'tempat_lahir' => fake()->city(),
            'tanggal_lahir' => fake()->date(),
            'jenis_kelamin' => fake()->randomElement(['L', 'P']),
            'anak_ke' => fake()->numberBetween(1, 10),
            'jumlah_saudara' => fake()->numberBetween(0, 10),
            'alamat' => fake()->address(),
            'no_telepon' => '08' . fake()->numerify('##########'),

            'father_name' => fake()->name(),
            'father_job' => fake()->jobTitle(),
            'father_email' => fake()->safeEmail(),
            'father_phone' => '08' . fake()->numerify('##########'),

            'mother_name' => fake()->name(),
            'mother_job' => fake()->jobTitle(),
            'mother_email' => fake()->safeEmail(),
            'mother_phone' => '08' . fake()->numerify('##########'),

            'parent_address' => fake()->address(),

            'income' => fake()->randomElement([
                '<1jt',
                '1-3jt',
                '3-5jt',
                '5-10jt',
                '>10jt'
            ]),

            'school_name' => fake()->company(),

            'education_level' => fake()->randomElement([
                'SD / MI',
                'SMP / MTs',
                'SMA / MA',
                'SMK'
            ]),

            'graduation_year' => fake()->year(),

            'blood_type' => fake()->randomElement([
                'A',
                'B',
                'AB',
                'O'
            ]),

            'quran_reading_ability' => fake()->randomElement([
                'belum_bisa',
                'iqro',
                'terbata',
                'lancar',
                'tartil'
            ]),

            'memorized_juz' => fake()->numberBetween(0, 30),

            'previous_pesantren' => fake()->randomElement([
                'ya',
                'tidak'
            ]),

            'agree_rules' => true,
            'agree_payment' => true,
            'agree_data_truth' => true,

            'status' => 'accepted',
            'last_step' => 9,
        ];
    }
}