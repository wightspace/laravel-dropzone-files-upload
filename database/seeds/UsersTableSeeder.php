<?php

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
        $data = [
            'name' => 'Teerapong Jaikhamma',
            'email' => 'teerapong@cmru.ac.th',
            'password' => bcrypt(env('PASSWORD_FOR_SEED', 1234))
        ];
        \App\User::create($data);
    }
}
