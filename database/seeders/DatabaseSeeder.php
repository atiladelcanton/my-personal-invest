<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\{Question, TypeInvestiment, User};
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::factory()->create([
            'name'     => 'Test User',
            'email'    => 'test@example.com',
            'password' => 123456789,
        ]);
        TypeInvestiment::factory()->create([
            'name'       => 'Reserva Emergencia',
            'percentage' => 10,
            'user_id'    => $user->id,
        ]);
    }
}
