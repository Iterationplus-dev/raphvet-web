<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'slug' => 'animal-treatment',
                'name' => 'Animal Treatment',
                'category' => 'treatment',
                'sort_order' => 1,
                'description' => 'Comprehensive medical care including diagnostics, surgery, and treatment for all types of animals.',
                'short_description' => 'Expert diagnosis, surgery and medical treatment for all animals.',
                'is_active' => true,
            ],
            [
                'slug' => 'veterinary-consultancy',
                'name' => 'Veterinary Consultancy',
                'category' => 'consultancy',
                'sort_order' => 2,
                'description' => 'Professional advice and consultation for animal health management and disease prevention.',
                'short_description' => 'Expert veterinary advice for animal health and disease prevention.',
                'is_active' => true,
            ],
            [
                'slug' => 'farm-management',
                'name' => 'Farm Management',
                'category' => 'farm_management',
                'sort_order' => 3,
                'description' => 'Comprehensive farm health management including herd health monitoring, nutrition planning, and productivity optimization.',
                'short_description' => 'Complete farm health management and livestock productivity solutions.',
                'is_active' => true,
            ],
            [
                'slug' => 'animal-feed',
                'name' => 'Animal Feed Production & Supply',
                'category' => 'feed_production',
                'sort_order' => 4,
                'description' => 'High-quality animal feed production, sales and supply for farms and pet owners across Nigeria.',
                'short_description' => 'Premium animal feed production, sales and supply.',
                'is_active' => true,
            ],
        ];

        foreach ($services as $data) {
            Service::firstOrCreate(
                ['slug' => $data['slug']],
                $data,
            );
        }
    }
}
