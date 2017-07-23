<?php
namespace App\Managers\Eloquent;

use App\Entity\Car;
use Illuminate\Support\Collection;
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
}
