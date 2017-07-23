<?php
namespace App\Http\Controllers\Api\Admin;

use App\Fractal\{
    Contracts\CarFractal,
    Transformers\CarTransformer
};
use App\Http\Controllers\Controller;
use App\Managers\Contracts\CarManager;
use Illuminate\Http\{Request, JsonResponse};

/**
 * Class AdminCarController
 * @package App\Http\Controllers\Api\Admin
 */
class AdminCarController extends Controller
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

        $this->middleware('can:cars.view')->only(['index', 'show']);
        $this->middleware('can:cars.create')->only(['store']);
        $this->middleware('can:cars.update')->only(['update']);
        $this->middleware('can:cars.delete')->only(['destroy']);
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

    /**
     * Stores a newly created car.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $car = $this->cars->create($request->only([
            'model',
            'registration_number',
            'year',
            'color',
            'mileage',
            'price',
            'user_id',
        ]));

        return response()->json($car->toArray());
    }

    /**
     * Updates the specified car by its id.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $this->cars->update($id, $request->only([
            'model',
            'registration_number',
            'year',
            'color',
            'mileage',
            'price',
            'user_id',
        ]));

        $car = $this->cars->find($id);

        return response()->json($car->toArray());
    }

    /**
     * Deletes the specified car by its id.
     *
     * @param  int $id
     * @return void
     */
    public function destroy(int $id): void
    {
        $this->cars->delete($id);
    }
}
