<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $ropa = Category::where('name', 'Ropa')->first();
        $accesorios = Category::where('name', 'Accesorios')->first();
        $calzado = Category::where('name', 'Calzado')->first();

        Product::create([
            'name' => 'Camiseta Overskull',
            'description' => 'Camiseta negra edición limitada',
            'price' => 89.90,
            'stock' => 50,
            'category_id' => $ropa->id,
        ]);

        Product::create([
            'name' => 'Gorra Overskull',
            'description' => 'Gorra negra con logo Overskull',
            'price' => 49.90,
            'stock' => 30,
            'category_id' => $accesorios->id,
        ]);

        Product::create([
            'name' => 'Zapatillas Overskull',
            'description' => 'Zapatillas urbanas edición limitada',
            'price' => 159.90,
            'stock' => 20,
            'category_id' => $calzado->id,
        ]);
    }
}