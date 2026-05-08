<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'company_id' => 1,
                'product_name' => '商品A',
                'price' => 1000,
                'comment' => '商品Aの説明',
                'img_path' => 'https://example.com/img/a.jpg',
            ],
            [
                'company_id' => 1,
                'product_name' => '商品B',
                'price' => 1500,
                'comment' => '商品Bの説明',
                'img_path' => 'https://example.com/img/b.jpg',
            ],
            [
                'company_id' => 2,
                'product_name' => '商品C',
                'price' => 2000,
                'comment' => '商品Cの説明',
                'img_path' => 'https://example.com/img/c.jpg',
            ],
        ]);
    }
}
