<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tenant;

class TenantSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(TenantSeeder::class);
    }
}

   
    {
        Tenant::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '0712345678',
            'id_number' => '12345678',
            'apartment_id' => 1,
            'house_unit_id' => 1,
            'agreement' => 'agreement_john.pdf',
        ]);

        Tenant::create([
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'phone' => '0798765432',
            'id_number' => '87654321',
            'apartment_id' => 2,
            'house_unit_id' => 5,
            'agreement' => 'agreement_jane.pdf',
        ]);
    }

