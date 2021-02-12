<?php

use Illuminate\Database\Seeder;
use App\User;
class CreateUsersSeeder extends Seeder
{
     /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
               'name'=>'Admin',
               'email'=>'admin@ebeetro.com',
                'is_admin'=>'1',
               'password'=> bcrypt('Ebeetr0@admin123'),
            ],
            [
               'name'=>'User',
               'email'=>'user@ebeetro.com',
                'is_admin'=>'0',
               'password'=> bcrypt('Ebeetr0@user123'),
            ],
        ];
  
        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
