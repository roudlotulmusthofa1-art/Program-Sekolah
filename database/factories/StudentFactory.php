<?php

namespace Database\Factories;

use App\Models\Student;
use App\Models\pendaftaranSiswa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'registration_code' => 'REG-' . fake()->unique()->numerify('########'),

            'pendaftaran_id' => \App\Models\PendaftaranSiswa::inRandomOrder()->value('id'),

            'guardian_id' => \App\Models\Guardian::inRandomOrder()->value('id'),

            'school_class_id' => \App\Models\SchoolClass::inRandomOrder()->value('id'),

            'nis' => fake()->unique()->numerify('2026######'),

            'name' => fake()->name(),

            'birth_place' => fake()->city(),

            'birth_date' => fake()->date(),

            'gender' => fake()->randomElement(['L', 'P']),

            'address' => fake()->address(),

            'phone' => fake()->phoneNumber(),

            'entry_date' => now(),

           'status' => fake()->randomElement(array_keys(PendaftaranSiswa::STATUS_LABELS)),

            'has_fee_scheme' => fake()->boolean(),
        ];
    }
}
