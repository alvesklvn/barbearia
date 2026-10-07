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
            'cellphone' => '(12) 99215-4660',
            'email_verified_at' => now(),
            'role_id' => '2',
            'password_hash' => "\$2y\$12\$/TupAjbh4ryrCj9ZndErQuEqPrRO7uy82kaQNJPjojZHdgttRJIoe",
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
