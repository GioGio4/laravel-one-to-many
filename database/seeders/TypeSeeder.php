<?php

namespace Database\Seeders;

use App\Models\Type;
use Faker\Generator as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $types_name = ['Games', 'Marketplace App', 'Web App', 'Mobile App', 'Authentication App'];

        foreach ($types_name as $type_name) {
            $type = new Type();

            $type->name = $type_name;
            $type->color = $faker->hexColor();

            $type->save();
        }
    }
}
