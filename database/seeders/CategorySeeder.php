<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = ['Мобильные телефоны', 'Портативная техника', 'Бытовая техника'];
        $codes = ['mobile', 'portable', 'technics'];
        $descriptions = ['Описание для мобильных телефонов', 'Описание для портативной техники', 'Описание для бытовой техники'];
        $images = ['mobile.jpg', 'portable.jpg', 'appliance.jpg'];
        for ($i = 0, $n = count($names); $i < $n; $i++) {
            Category::create([
                'name' => $names[$i],
                'code' => $codes[$i],
                'description' => $descriptions[$i],
                'image' => 'categories/' . $images[$i]
            ]);
        }
    }
}
