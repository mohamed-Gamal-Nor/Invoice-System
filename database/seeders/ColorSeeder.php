<?php

namespace Database\Seeders;

use App\Models\colors;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{

    public function run()
    {
        $colorsName = [
            "black"=>"#000000",
            "silver"=>"#c0c0c0",
            "gray"=>"#808080",
            "white"=>"#ffffff",
            "maroon"=>"#800000",
            "red"=>"#ff0000",
            "purple"=>"#800080",
            "fuchsia"=>"#ff00ff",
            "green"=>"#008000",
            "lime"=>"#00ff00",
            "olive"=>"#808000",
            "yellow"=>"#ffff00",
            "navy"=>"#000080",
            "blue"=>"#0000ff",
            "teal"=>"#008080",
            "aqua"=>"#00ffff",
        ];
        foreach ($colorsName as $index => $value) {
            $data2 = array(
                'name'=>$index,
                "rgb"=>$value,
                'created_by'=>1,
                "created_at" => date("Y-m-d h:i:s"),
            );
            colors::insert($data2);
        }
    }
}
