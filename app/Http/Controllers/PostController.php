<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \App\Models\Posts;
class PostController extends Controller
{

    public function add_posts(){
        DB::beginTransaction();
		
        
        try {
         
         DB::table('posts')->where('id', '>', "4")->lockForUpdate()->get();
    
        Posts::insert("insert into posts (post_title,post_content,author_name) values (?, ?,?)",["Test 13","Thsi is the test","admin 3"]);
            sleep(10);
            Posts::insert("insert into posts (post_title,post_content,author_name) values (?, ?,?)",["Test 124","Thsi is the test","admin 4"]);
            sleep(10);
           Posts::insert("insert into posts (post_title,post_content,author_name) values (?, ?,?)",["Test 5","Thsi is the test","admin 5"]);
            sleep(10);
            Posts::insert("insert into posts (post_title,post_content,author_name) values (?, ?,?)",["Test j3","Thsi is the test","admin 3"]);
            sleep(10);
            Posts::insert("insert into posts (post_title,post_content,author_name) values (?, ?,?)",["Test 84","Thsi is the test","admin 4"]);
            sleep(10);
            DB::commit();
        
            return "all good";
        } catch (\Exception $e) {
            DB::rollback();
            

            // something went wrong
            return "something went wrong".$e->getMessage();
        }
    }
    public function getPosts(){
        
       $posts= DB::table('posts')->where('id', "3")->lockForUpdate()->get();
       $post=Posts::Find("3");
       $post->post_title="new qwe 123";
       $post->save();
       
        return ["post"=>$posts,"hhh"=>'re']; 
    }
}
