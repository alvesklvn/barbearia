<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'barbeiro',
            'email' => 'admin@barbearia.com',
            'cellphone' => '+5599999999999',
            'email_verified_at' => now(),
            'role_id' => '2',
            #a senha do login de barbeiro é "admin123_"
            'password_hash' => "\$2y\$12\$H8PVr24GQwrYMr2/kWSUgO.9rZNmmmJOqhFSA9G7wVpp3XhNzR7Pi",
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('barbers')->insert([
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
