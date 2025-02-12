<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $images =[
            "products/01JKKN9H229Q54AEJWVE7XNJNY.webp",
            "products/01JKKN9J38NFC8XXF9VE705C5F.webp"
        ];

        for ($i = 1; $i <= 1000; $i++) {
            $name = [
                'ar' => 'منتج ' . $i,
                'en' => 'Product ' . $i
            ];

            $slug = Str::slug($name['en'] . '-' . $i);
            $description = [
                'ar' => 'وصف المنتج ' . $i,
                'en' => 'Product description ' . $i
            ];

            Product::create([
                'category_id'  => rand(1, 8), // Category between 1 and 8
                'name'         => $name,
                'slug'         => $slug,
                'images'       => $images, // Pick a random image
                'description'  => $description,
                'price'        => rand(5, 100), // Random price between 5 and 100
                'is_active'    => 1,
                'in_stock'     => rand(0, 1), // Randomly in stock or not
                'is_featured'  => rand(0, 1), // Randomly featured or not
                'qr_code'      => url('/product/' . $i),
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);
        }
    }
}
