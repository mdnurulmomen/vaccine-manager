<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use App\Models\VaccineCenter;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::factory(1)->admin()->create();

        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@email.com',
            'email_verified_at' => now(),
            'mobile' => '01'.fake()->randomDigitNotNull().fake()->numerify('########'),
            'nid' => fake()->numerify('########'),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'is_admin' => true,
            'vaccine_center_id' => VaccineCenter::inRandomOrder()->first()->id,
            'remember_token' => Str::random(10),
        ]);
    }
}
