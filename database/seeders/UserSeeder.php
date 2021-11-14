<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Trần Quang Long',
            'email' => 'qlonga2k44@gmail.com',
            'password' => bcrypt('password')
        ]);

        $user->restaurant()->create([
            'name' => 'Highway Star',
            'location' => '3 Vu Pham Ham, Cau Giay'
        ]);

        $user->restaurant()->create([
            'name' => 'Longs restaurant',
            'location' => '28 Nguyen Thai Hoc'
        ]);

        $user->restaurant()->create([
            'name' => 'Juicy restaurant',
            'location' => '72 Le Loi'
        ]);
    }
}
