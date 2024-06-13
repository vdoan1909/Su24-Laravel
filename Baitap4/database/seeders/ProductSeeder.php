<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductGallery;
use App\Models\ProductSize;
use App\Models\ProductVariant;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        
        ProductVariant::truncate();
        ProductGallery::truncate();
        DB::table('product_tag')->truncate();
        Product::truncate();
        ProductSize::truncate();
        ProductColor::truncate();
        Tag::truncate();

        Tag::factory(10)->create();

        // S, M, L ,XL, XXL
        foreach (['S', 'M', 'L', 'XL', 'XXL'] as $size) {
            ProductSize::create([
                'name' => $size
            ]);
        }

        // #00FF00, #0000FF, #FF00FF ,#FF0000, #FF3366
        foreach (['#00FF00', '#0000FF', '#FF00FF', '#FF0000', '#FF3366'] as $color) {
            ProductColor::create([
                'name' => $color
            ]);
        }

        for ($i = 1; $i <= 100; $i++) {
            $name = fake()->text(60);
            Product::create(
                [
                    'catalogue_id' => rand(1, 3),
                    'name' => $name,
                    'slug' => Str::slug($name) . '-' . Str::random(6),
                    'sku' => strtoupper(Str::random(5) . $i),
                    'img_thumbnail' => 'https://design-jm.com/wp-content/uploads/2021/02/1111111111-scaled.jpg',
                    'price_regular' => 600000,
                    'price_sale' => 360000,
                ]
            );
        }

        for ($i = 1; $i <= 100; $i++) {
            ProductGallery::insert(
                [
                    [
                        'product_id' => $i,
                        'image' => 'https://design-jm.com/wp-content/uploads/2021/02/1111111111-scaled.jpg'
                    ],
                    [
                        'product_id' => $i,
                        'image' => 'https://etrendipohsdnbhd.com/wp-content/uploads/2021/04/philipp-plein-t-shirt-round-neck-ss-limited-edition-skull-01.jpg'
                    ]
                ],

            );
        }

        for ($i = 1; $i <= 100; $i++) {
            DB::table('product_tag')->insert([
                [
                    'product_id' => $i,
                    'tag_id' => rand(1, 5)
                ],
                [
                    'product_id' => $i,
                    'tag_id' => rand(6, 10)
                ]
            ]);
        }

        for ($productID = 1; $productID <= 100; $productID++) {
            $data = [];
            for ($sizeID = 1; $sizeID <= 5; $sizeID++) {
                for ($colorID = 1; $colorID <= 5; $colorID++) {
                    $data[] = [
                        'product_id' => $productID,
                        'product_size_id' => $sizeID,
                        'product_color_id' => $colorID,
                        'quantity' => 99,
                        'image' => 'https://media-catalog.giglio.com/images/f_auto/t_prodZoom/v1/products/E79233.002_1/philipp-plein.jpg',
                    ];
                }
            }

            DB::table('product_variants')->insert($data);
        }
    }
}
