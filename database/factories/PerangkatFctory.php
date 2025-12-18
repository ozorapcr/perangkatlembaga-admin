<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PerangkatFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nama_perangkat' => $this->faker->randomElement([
                'Kepala Desa',
                'Sekretaris Desa',
                'Kaur Keuangan',
                'Kaur Umum',
                'Kasi Pemerintahan',
                'Kasi Pelayanan'
            ]),
            'nama_pejabat' => $this->faker->name(),
            'deskripsi' => $this->faker->paragraph(4),
            'foto' => 'assets/img/placeholder.png'
        ];
    }
}
