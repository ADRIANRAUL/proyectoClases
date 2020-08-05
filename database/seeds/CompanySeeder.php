<?php

use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $records=array(
            array('name'=>"Let's Code ", 'phone'=>'1234567890', 'email'=>'info@letscode.com', 'address'=>'Riobamba'),
        );

        DB::table('companies')->insert($records);
    }
}
