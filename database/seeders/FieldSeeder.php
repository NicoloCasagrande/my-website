<?php

namespace Database\Seeders;

use App\Models\Field;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class FieldSeeder extends Seeder
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
        Field::truncate();
        Schema::enableForeignKeyConstraints();

        $categories = ['Frontend', 'Backend', 'Devops', 'AI'];

        foreach ($categories as $category) {
            $new_field = new Field();
            $new_field->name = $category;
            $new_field->slug = Str::slug($new_field->name);
            $new_field->save();
        }
    }
}
