<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('testimonials')->insert([
            [
                'name' => 'John Doe',
                'image' => 'john_doe.jpg',
                'position' => 'CEO at Example Co.',
                'description' => 'This is a great company! Their services are top-notch.',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jane Smith',
                'image' => 'jane_smith.jpg',
                'position' => 'Marketing Director at XYZ Ltd.',
                'description' => 'Highly recommend! They truly understand the market.',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Samuel Green',
                'image' => 'samuel_green.jpg',
                'position' => 'Product Manager at ABC Inc.',
                'description' => 'An amazing experience working with this team.',
                'status' => 'inactive',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
