<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('companies')->insert([
            ['company_name' => 'A社'],
            ['company_name' => 'B社'],
            ['company_name' => 'C社'],
        ]);
    }
   
}
