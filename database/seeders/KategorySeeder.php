<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategori = [
            ['name' => 'Elektronik'],
            ['name' => 'Peralatan Kantor'],
            ['name' => 'Furniture'],
            ['name' => 'ATK'],
            ['name' => 'Lainnya'],
        ];

        foreach ($kategori as $item) {
            DB::table('kategori_barangs')->insert([
                'name' => $item['name'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
