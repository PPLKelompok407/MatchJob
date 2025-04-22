<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'notelp' => fake()->phoneNumber(),
            'password' => static::$password ??= Hash::make('password'),
            'jenisa_kelamin' => fake()->randomElement(['Laki-laki', 'Perempuan']),
            'riwayat_pendidikan' => fake()->sentence(),
            'tempat_tanggal_lahir' => fake()->city() . ', ' . fake()->date(),
            'alamat' => fake()->address(),
            'riwayat_kerja' => fake()->company(),
            'remember_token' => Str::random(10),
        ];
    }
}
