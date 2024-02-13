<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\VendorCategory;

class VendorCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['Category_name' => 'Wedding Planners', 'Category_description' => '', 'Category_image' => 'WeddingPlanner.jpg', 'Category_icon' => 'icons8-planner-64.png'],
            ['Category_name' => 'Photographers', 'Category_description' => '', 'Category_image' => 'photographer1.jpg', 'Category_icon' => 'icons8-slr-camera-64.png'],
            ['Category_name' => 'Reception Venues', 'Category_description' => '', 'Category_image' => 'reception_venues.jpg', 'Category_icon' => 'hotel.png'],
            ['Category_name' => 'Favors & Gifts', 'Category_description' => '', 'Category_image' => 'Gifts.jpg', 'Category_icon' => 'icons8-wedding-gift-64.png'],
            ['Category_name' => 'Catering', 'Category_description' => '', 'Category_image' => 'catering.jpg', 'Category_icon' => 'icons8-catering-64.png'],
            ['Category_name' => 'Music & DJs', 'Category_description' => '', 'Category_image' => 'DJ.jpg', 'Category_icon' => 'icons8-music-heart-64.png'],
            ['Category_name' => 'Bridal Accessories', 'Category_description' => '', 'Category_image' => 'bridal_accesories.jpg', 'Category_icon' => 'icons8-jewelry-64.png\r\n'],
            ['Category_name' => 'Florists', 'Category_description' => '', 'Category_image' => 'florists.jpg', 'Category_icon' => 'icons8-flower-bouquet-64.png'],
            ['Category_name' => 'Stationary', 'Category_description' => '', 'Category_image' => 'Stationary.jpg', 'Category_icon' => 'icons8-greeting-card-64.png'],
            ['Category_name' => 'Bridal Salons', 'Category_description' => '', 'Category_image' => 'Bridal Salons.jpg', 'Category_icon' => 'icons8-beauty-salon-64.png'],
            ['Category_name' => 'Wedding Decor', 'Category_description' => '', 'Category_image' => 'Wed decor1.jpg', 'Category_icon' => 'icons8-flower-doodle-64.png'],
            ['Category_name' => 'Hotel Room Blocks', 'Category_description' => '', 'Category_image' => 'HotelRoomBlocks.jpg', 'Category_icon' => 'icons8-door-hanger-64.png'],
            ['Category_name' => 'Jewellery', 'Category_description' => '', 'Category_image' => 'jewelery.jpg', 'Category_icon' => 'icons8-wedding-rings-64.png'],
            ['Category_name' => 'Bridal Wear', 'Category_description' => '', 'Category_image' => 'BridalWear1.jpg', 'Category_icon' => 'dress.png'],
            ['Category_name' => 'Cars & Travel', 'Category_description' => '', 'Category_image' => 'car.jpg', 'Category_icon' => 'icons8-sedan-64.png'],
            ['Category_name' => 'Groom Wear', 'Category_description' => '', 'Category_image' => 'GroomWear2.jpg', 'Category_icon' => 'icons8-suit-64.png'],
            ['Category_name' => 'Wedding Cakes', 'Category_description' => '', 'Category_image' => 'cake.jpg', 'Category_icon' => 'icons8-birthday-cake-64.png'],
            ['Category_name' => 'Videographers', 'Category_description' => '', 'Category_image' => 'videographer.jpg', 'Category_icon' => 'icons8-video-camera-64.png'],
            ['Category_name' => 'Poruwa Ceremony', 'Category_description' => null, 'Category_image' => 'ceremony2.jpg', 'Category_icon' => 'icons8-wedding-64.png'],
        ];

        foreach ($data as $category) {
            VendorCategory::create($category);
        }
    }
}
