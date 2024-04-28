<?php

namespace Database\Seeders;

use App\Models\Organization;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrganizationsTableSeeder extends Seeder
{
    
            public function run(): void
            {
                Factory::factory(Organization::class, 10)->create();
            }
        
       
    
}
