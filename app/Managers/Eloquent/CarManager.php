<?php
namespace App\Managers\Eloquent;

use App\Entity\Car;
use App\Entity\User;
use Illuminate\Support\Collection;
use App\Jobs\SendNotificationEmail;
use App\Managers\AbstractEntityManager;
use App\Managers\Contracts\CarManager as CarManagerContract;

/**
 * Class CarManager
 * @package App\Managers\Eloquent
 */
class CarManager extends AbstractEntityManager implements CarManagerContract
{
    /**
     * @inheritdoc
     */
    public function entity(): string
    {
        return Car::class;
    }

    /**
     * @inheritdoc
     */
    public function findAllFromActiveUsers(): Collection
    {
        return $this->entity->whereHas('user', function ($query) {
            $query->active();
        })->get();
    }

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
