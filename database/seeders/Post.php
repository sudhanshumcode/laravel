<?php

namespace Database\Seeders;
use \App\Models\Posts;
use Illuminate\Database\Seeder;

class Post extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $post =new Posts();
        $post->post_title="Test 1";
        $post->post_content="This is the dummy Test";
        $post->author_name="admin 1";
        $post->save();

        $post_1 =new Posts();
        $post_1->post_title="Test 2";
        $post_1->post_content="This is the dummy Test";
        $post_1->author_name="admin 2";
        
        $post_1->save();

        $post_2 =new Posts();
        $post_2->post_title="Test 12";
        $post_2->post_content="This is the dummy Test";
        $post_2->author_name="admin 12";
        
        $post_2->save();
    }
}
