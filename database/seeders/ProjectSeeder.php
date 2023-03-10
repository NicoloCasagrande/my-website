<?php

namespace Database\Seeders;

use App\Models\Field;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Type;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Schema;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        Schema::disableForeignKeyConstraints();
        //cancello tutti i dati della tabella categories
        Project::truncate();
        Schema::enableForeignKeyConstraints();

        for ($i=0; $i < 10; $i++) { 
            $type = Type::inRandomOrder()->first();
            $field = Field::inRandomOrder()->first();
            
            $new_project = new Project();
            $new_project->title = $faker->word();
            $new_project->content = $faker->text();
            $new_project->slug = Str::slug($new_project->title);
            $new_project->type_id = $type->id;
            $new_project->field_id = $field->id;
            $new_project->save();
        }
    }
}
