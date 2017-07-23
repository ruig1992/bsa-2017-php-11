<?php
namespace App\Traits\Jobs;

use App\Entity\Car;
use App\Entity\User;
use App\Jobs\SendNotificationEmail;

/**
 * Trait DispatchCarStoredNotification
 * @package App\Traits\Jobs
 */
trait DispatchCarStoredNotification
{
    /**
     * Dispatch CarStored Notification.
     *
     * @param  \App\Entity\Car $car
     * @param  \App\Entity\User|null $user
     *
     * @return void
     */
    public function carStoredNotification(Car $car, User $user = null): void
    {
        $job = (new SendNotificationEmail($user, $car))->onQueue('notification');
        dispatch($job);
    }
}
