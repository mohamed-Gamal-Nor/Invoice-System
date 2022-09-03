<?php

namespace Database\Seeders;

use App\Models\sizes;
use Illuminate\Database\Seeder;

class SizeSeeder extends Seeder
{

    public function run()
    {
        $sizeName = [
            "S",
            "M",
            "XL",
            "XXL",
            "XXXL",
            "XXXXL",
            "XXXXXL",
        ];
        foreach ($sizeName as $size) {
            sizes::create(['name' => $size,'created_by'=>1]);
        }
    }
}
