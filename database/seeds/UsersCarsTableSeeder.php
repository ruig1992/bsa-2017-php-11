<?php

use App\Entity\Car;
use App\Entity\User;
use Illuminate\Database\Seeder;

class UsersCarsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $maxCars = 3;

        factory(User::class, 5)->create()->each(function($u) use ($maxCars) {
            for ($i = 0; $i < random_int(0, $maxCars); $i++) {
                $u->cars()->save(factory(Car::class)->make());
            }
        });
    }
}
