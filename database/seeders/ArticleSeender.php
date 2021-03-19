<?php

namespace Database\Seeders;
use \App\Models\Article;
use Illuminate\Database\Seeder;

class Articleseender extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Article::factory(30)->create();
	//	 $this->call(UserSeed::class);
         
    }
}
