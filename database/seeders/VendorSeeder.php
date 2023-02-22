<?php

namespace Database\Seeders;

use App\Models\Vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Vendor::truncate();
        Schema::enableForeignKeyConstraints();

        $data = [
            'Toyota', 'Honda', 'Suzuki'
        ];

        foreach ($data as $value){
            Vendor::insert([
                'name' => $value
            ]);
        }
    }
}
