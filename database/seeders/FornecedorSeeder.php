<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fornecedor;

class FornecedorSeeder extends Seeder
{
    public function run()
    {
        Fornecedor::create([
            'razao_social' => 'Fornecedor A',
            'cnpj' => '12345678901234',
            'email' => 'fornecedor@example.com',
            'telefone' => '1234567890',
        ]);

        Fornecedor::create([
            'razao_social' => 'Fornecedor B',
            'cnpj' => '98765432109876',
            'email' => 'fornecedor2@example.com',
            'telefone' => '9876543210',
        ]);

        Fornecedor::create([
            'razao_social' => 'Fornecedor C',
            'cnpj' => '54321098765432',
            'email' => 'fornecedor3@example.com',
            'telefone' => '5432109876',
        ]);
    }
}