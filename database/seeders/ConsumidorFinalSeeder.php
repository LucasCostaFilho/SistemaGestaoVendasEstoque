<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Cliente;

class ConsumidorFinalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cliente::firstOrCreate(
        ['cpf' => '000.000.000-00'], 
        
        ['nome_completo' => 'Consumidor Final']
    );
    }
}
