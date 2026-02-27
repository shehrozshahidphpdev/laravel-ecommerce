<?php

namespace Database\Seeders;

use App\Models\Admin\Specification;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpecificaitonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $specifications = [

            'Brand',
            'Model',
            'Release Year',
            'Processor',
            'RAM',
            'Storage',
            'Operating System',
            'Display Size',
            'Display Type',
            'Resolution',
            'Refresh Rate',
            'Battery Capacity',
            'Battery Life',
            'Fast Charging',
            'Rear Camera',
            'Front Camera',
            'GPU',
            'Weight',
            'Dimensions',
            'Build Material',
            'WiFi',
            'Bluetooth',
            'Water Resistance',
            'Warranty',
            'In the Box'
        ];

        foreach ($specifications as $specification) {
            Specification::create([
                'label' => $specification
            ]);
        }
    }
}
