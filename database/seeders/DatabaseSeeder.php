<?php

namespace Database\Seeders;

use App\Models\{User,cliente};
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::insert(['name' => 'Administrador', 'email' => 'admin@admin.com.ar', 'password' => '$2y$10$TrLvj6no.ctQFCn.A/nv6uCkYsPkYQhySjXz7cEWJstB7r61teqI2']);
        cliente::insert(['nombre'=> 'Cliente General','domicilio' =>'-','cuit'=>'00-00000000-0','email'=>'none@mail.com']);
    }
}
