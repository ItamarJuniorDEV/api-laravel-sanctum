<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; 

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User();
        $user->name = 'AppConsumer01';
        $user->email = 'app001@api.com';
        $user->password = bcrypt('Aa123456');
        $user->save();
    }
}
