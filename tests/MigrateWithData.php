<?php

namespace Tests;

use App\Entity\Car;
use App\Entity\User;
use Illuminate\Support\Facades\Artisan;

trait MigrateWithData
{
    public function migrateWithData()
    {
        Artisan::call("migrate:refresh");
        factory(User::class)->create(['id' => 1]);
        factory(Car::class)->create();
    }
}
