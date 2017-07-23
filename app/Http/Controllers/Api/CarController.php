<?php
namespace App\Http\Controllers\Api;

use App\Fractal\{
    Contracts\CarFractal,
    Transformers\CarTransformer
};
use App\Http\Controllers\Controller;
use App\Managers\Contracts\CarManager;
use Illuminate\Http\{Request, JsonResponse};

/**
 * Class CarController
 * @package App\Http\Controllers\Api
 */
class CarController extends Controller
{
    /**
     * @var \App\Managers\Contracts\CarManager
     */
    protected $cars;
    /**
     * @var \App\Fractal\Contracts\CarFractal
     */
    protected $fractal;

    /**
     * @param \App\Managers\Contracts\CarManager $cars
     * @param \App\Fractal\Contracts\CarFractal $fractal
     */
    public function __construct(CarManager $cars, CarFractal $fractal)
    {
        $this->cars = $cars;
        $this->fractal = $fractal->setEntityManager($this->cars);
    }

    /**
     * Gets and displays the list of all cars.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $cars = $this->fractal
            ->setTransformer(CarTransformer::class)
            ->collection($request->only([
                'per_page', 'include'
            ]));

        return response()->json($cars->toArray());
    }

    /**
     * Gets and displays the full information about the car by its id.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, int $id): JsonResponse
    {
        $car = $this->fractal
            ->setTransformer(CarTransformer::class)
            ->item($id, $request->only(['include']));

        return response()->json($car->toArray());
    }
}
