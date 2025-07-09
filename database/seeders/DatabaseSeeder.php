<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ConsumidorFinalSeeder::class,
            RoleSeeder::class,
            CategoriaProdutoSeeder::class,
            ProdutoSeeder::class,
            VariacaoProdutoSeeder::class,
            FornecedorSeeder::class,
        ]);
    }
}
