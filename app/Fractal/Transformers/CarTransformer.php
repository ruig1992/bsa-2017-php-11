<?php
namespace App\Fractal\Transformers;

use App\Entity\Car;
use League\Fractal\TransformerAbstract;

/**
 * Class CarTransformer
 * @package App\Fractal\Transformers
 */
class CarTransformer extends TransformerAbstract
{
    /**
     * @inheritdoc
     */
    protected $availableIncludes = ['user'];

    /**
     * Fractal transform the Car data.
     *
     * @param \App\Entity\Car $car
     * @return array
     */
    public function transform(Car $car): array
    {
        return [
            'id' => $car->id,
            'model' => $car->model,
            'registration_number' => $car->registration_number,
            'year' => $car->year,
            'color' => $car->color,
            'mileage' => $car->mileage,
            'price' => $car->price,
        ];
    }

    /**
     * Include the User data.
     *
     * @param \App\Entity\Car $car
     * @return \League\Fractal\Resource\Item
     */
    public function includeUser(Car $car)
    {
        return $this->item($car->user, new UserTransformer);
    }
}
