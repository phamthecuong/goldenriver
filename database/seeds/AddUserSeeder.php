<?php

use Illuminate\Database\Seeder;

class AddUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\User::create([
            'email' => 'admin@gmail.com',
            'name' => 'administrator',
            'is_active' => 1,
            'password' => \Illuminate\Support\Facades\Hash::make('123456')
        ]);

        \Modules\core\models\UserProfile::create([
            'user_id' => $user->id,
            'title' => 'SuperAdmin'
        ]);
    }
}
