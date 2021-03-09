<?php

namespace Database\Seeders;
use \App\Models\User;

use Illuminate\Database\Seeder;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
		$user =new User();
		$user->name="sudhanshu_123";
		$user->email="sudhanshu20@gmail.com";
		$user->email_verified_at=null;
		$user->password=bcrypt("admin@123");
		$user->remember_token=null;
		$user->save();
		
		$user_1 =new User();
		$user_1->name="sudhanshu_123";
		$user_1->email="sudhanshu21@gmail.com";
		$user_1->email_verified_at=null;
		$user_1->password=bcrypt("admin@123");
		$user_1->remember_token=null;
		$user_1->save();
		
		$user_2 =new User();
		$user_2->name="sudhanshu_123";
		$user_2->email="sudhanshu22@gmail.com";
		$user_2->email_verified_at=null;
		$user_2->password=bcrypt("admin@123");
		$user_2->remember_token=null;
		$user_2->save();
    }
}
