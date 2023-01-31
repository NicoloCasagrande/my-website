<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        //cancello tutti i dati della tabella categories
        Technology::truncate();
        Schema::enableForeignKeyConstraints();

        $categories = ['Html', 'JS', 'PHP', 'VueJS'];

        foreach ($categories as $category) {
            $new_technology = new Technology();
            $new_technology->name = $category;
            $new_technology->slug = Str::slug($new_technology->name);
            $new_technology->save();
        }
    }
}
