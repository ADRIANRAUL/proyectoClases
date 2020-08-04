<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $records = array(
            array('name'=>'Adrian','phone'=>'9876543210','email'=>'adrian@email.com','password'=>bcrypt('123456'),'company_id'=>1)
        );
        DB::table('users')->insert($records);
    }
}
