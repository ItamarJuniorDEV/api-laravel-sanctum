<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User;
        $user->name = 'AppConsumer01';
        $user->email = 'app001@api.com';
        $user->password = bcrypt('Aa123456');
        $user->save();
    }
}
