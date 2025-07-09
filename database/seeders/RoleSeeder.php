<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::firstOrCreate(['name' => 'Gerente', 'description' => 'Acessa relatórios']);
        Role::firstOrCreate(['name' => 'Vendedor', 'description' => 'Acessa vendas']);
        Role::firstOrCreate(['name' => 'Estoquista', 'description' => 'Acessa estoque']);
    }
}
