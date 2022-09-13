<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
                'name'=> 'user',
                'email'=> 'superadmin@3dweb.com',
                'password'=> bcrypt('123456!'),
                'admin'=> 1
            ]
        ); 
            
        //TO DO NEW USER
    }  
        
        
    
}
