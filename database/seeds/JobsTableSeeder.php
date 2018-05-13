<?php

    use Faker\Factory;
    use Illuminate\Database\Seeder;
use App\Model\Job;

class JobsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Job::truncate();

        $categories = (config('jobs.categories'));
        $categoriesList =   explode(',', $categories);


        for ($i = 0; $i < 10; $i++) {
            $randomCategoryKey = rand(0,count($categoriesList)-1);

            $faker = Factory::create();
            $title = $faker->jobTitle;
            Job::create([
                'title' => $title,
                'category' => $categoriesList[$randomCategoryKey],
                'description' => $title. " description",

                'location' => $faker->city
            ]);
        }

    }
}
