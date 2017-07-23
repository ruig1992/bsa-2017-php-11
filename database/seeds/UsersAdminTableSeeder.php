<?php

use App\Entity\User;
use Illuminate\Database\Seeder;

class UsersAdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([
            'first_name' => 'Admin',
            'last_name' => 'Boss',
            'email' => 'admin@example.com',
            'is_active' => true,
            'is_admin' => true,
        ]);
    }
}
