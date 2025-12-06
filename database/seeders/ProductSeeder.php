<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            // Electronics
            [
                'name' => 'Wireless Bluetooth Headphones',
                'description' => 'Premium noise-canceling wireless headphones with 30-hour battery life, deep bass, and crystal-clear audio. Perfect for music lovers and professionals.',
                'price' => 149.99,
                'stock' => 50,
                'category' => 'Electronics',
                'image' => 'headphones.png',
            ],
            [
                'name' => 'Smart Watch Pro',
                'description' => 'Advanced smartwatch with heart rate monitor, GPS tracking, sleep analysis, and water resistance up to 50m. Compatible with iOS and Android.',
                'price' => 299.99,
                'stock' => 35,
                'category' => 'Electronics',
                'image' => 'smartwatch.png',
            ],
            [
                'name' => 'Portable Power Bank 20000mAh',
                'description' => 'High-capacity portable charger with fast charging support. Charge your phone up to 5 times. Slim design fits in your pocket.',
                'price' => 49.99,
                'stock' => 100,
                'category' => 'Electronics',
                'image' => 'powerbank.png',
            ],
            [
                'name' => '4K Ultra HD Webcam',
                'description' => 'Professional grade webcam with 4K resolution, auto-focus, and built-in ring light. Perfect for streaming and video conferencing.',
                'price' => 129.99,
                'stock' => 25,
                'category' => 'Electronics',
                'image' => 'webcam.png',
            ],

            // Fashion
            [
                'name' => 'Premium Leather Jacket',
                'description' => 'Genuine leather jacket with modern slim fit design. Features multiple pockets and durable YKK zippers. Available in black and brown.',
                'price' => 249.99,
                'stock' => 20,
                'category' => 'Fashion',
                'image' => 'leather_jacket.png',
            ],
            [
                'name' => 'Designer Sunglasses',
                'description' => 'UV400 protection polarized sunglasses with titanium frame. Lightweight and comfortable for all-day wear.',
                'price' => 89.99,
                'stock' => 45,
                'category' => 'Fashion',
                'image' => 'sunglasses.png',
            ],
            [
                'name' => 'Canvas Backpack',
                'description' => 'Durable canvas backpack with laptop compartment, multiple organizer pockets, and water-resistant coating. Perfect for work or travel.',
                'price' => 79.99,
                'stock' => 60,
                'category' => 'Fashion',
                'image' => 'backpack.png',
            ],

            // Home & Garden
            [
                'name' => 'Smart LED Desk Lamp',
                'description' => 'Adjustable LED desk lamp with touch control, 5 brightness levels, and USB charging port. Eye-caring technology reduces strain.',
                'price' => 45.99,
                'stock' => 80,
                'category' => 'Home & Garden',
                'image' => 'desk_lamp.png',
            ],
            [
                'name' => 'Robot Vacuum Cleaner',
                'description' => 'Intelligent robot vacuum with app control, automatic charging, and powerful suction. Maps your home for efficient cleaning.',
                'price' => 399.99,
                'stock' => 15,
                'category' => 'Home & Garden',
                'image' => 'robot_vacuum.png',
            ],
            [
                'name' => 'Indoor Plant Set',
                'description' => 'Collection of 3 low-maintenance indoor plants in decorative ceramic pots. Includes care guide. Perfect for beginners.',
                'price' => 59.99,
                'stock' => 30,
                'category' => 'Home & Garden',
                'image' => 'indoor_plants.png',
            ],

            // Sports & Outdoors
            [
                'name' => 'Yoga Mat Premium',
                'description' => 'Extra thick 6mm yoga mat with non-slip surface. Eco-friendly TPE material, includes carrying strap. Available in multiple colors.',
                'price' => 34.99,
                'stock' => 75,
                'category' => 'Sports & Outdoors',
                'image' => 'yoga_mat.png',
            ],
            [
                'name' => 'Adjustable Dumbbells Set',
                'description' => 'Space-saving adjustable dumbbells from 5-52.5 lbs. Quick-change weight system. Perfect for home gym.',
                'price' => 349.99,
                'stock' => 20,
                'category' => 'Sports & Outdoors',
                'image' => 'dumbbells.png',
            ],
            [
                'name' => 'Camping Tent 4-Person',
                'description' => 'Waterproof 4-person camping tent with easy setup. Features ventilation windows and rainfly. Packs into compact carry bag.',
                'price' => 159.99,
                'stock' => 25,
                'category' => 'Sports & Outdoors',
                'image' => 'camping_tent.png',
            ],

            // Books & Media
            [
                'name' => 'Bestseller Book Bundle',
                'description' => 'Collection of 5 bestselling fiction novels from top authors. Perfect gift for book lovers. Includes hardcover editions.',
                'price' => 69.99,
                'stock' => 40,
                'category' => 'Books & Media',
                'image' => 'books.png',
            ],
            [
                'name' => 'Digital Drawing Tablet',
                'description' => '10-inch drawing tablet with 8192 pressure levels and tilt support. Includes stylus pen and drawing software.',
                'price' => 199.99,
                'stock' => 30,
                'category' => 'Books & Media',
                'image' => 'drawing_tablet.png',
            ],

            // Health & Beauty
            [
                'name' => 'Skincare Essential Kit',
                'description' => 'Complete skincare routine with cleanser, toner, serum, and moisturizer. Suitable for all skin types. Cruelty-free and vegan.',
                'price' => 89.99,
                'stock' => 55,
                'category' => 'Health & Beauty',
                'image' => 'skincare.png',
            ],
            [
                'name' => 'Electric Massage Gun',
                'description' => 'Powerful percussion massage gun with 6 attachments and 20 speed levels. Relieves muscle tension and improves recovery.',
                'price' => 129.99,
                'stock' => 40,
                'category' => 'Health & Beauty',
                'image' => 'massage_gun.png',
            ],
            [
                'name' => 'Aromatherapy Diffuser',
                'description' => 'Ultrasonic essential oil diffuser with color-changing LED lights. 300ml capacity, whisper-quiet operation. Includes 3 essential oils.',
                'price' => 39.99,
                'stock' => 65,
                'category' => 'Health & Beauty',
                'image' => 'diffuser.png',
            ],
        ];

        foreach ($products as $product) {
            $category = Category::where('name', $product['category'])->first();
            
            Product::create([
                'name' => $product['name'],
                'slug' => Str::slug($product['name']),
                'description' => $product['description'],
                'price' => $product['price'],
                'stock' => $product['stock'],
                'category_id' => $category->id,
                'image' => $product['image'],
            ]);
        }
    }
}
