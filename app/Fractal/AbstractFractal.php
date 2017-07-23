<?php
namespace App\Fractal;

use League\Fractal\{
    Manager as Fractal,
    TransformerAbstract,
    Scope as FractalScope,
    Resource\Item as FractalItem,
    Resource\Collection as FractalCollection,
    Pagination\IlluminatePaginatorAdapter
};
use App\Managers\Contracts\EntityManager;
use App\Managers\Eloquent\Criteria\EagerLoad;

/**
 * Class AbstractFractal
 * @package App\Fractal
 */
abstract class AbstractFractal
{
    /**
     * @var \App\Managers\Contracts\EntityManager
     */
    protected $entities;
    /**
     * @var \League\Fractal\Manager
     */
    protected $fractal;
    /**
     * @var string
     */
    protected $transformer;

    /**
     * @param \League\Fractal\Manager $fractal
     */
    public function __construct(Fractal $fractal)
    {
        $this->fractal = $fractal;
    }

    /**
     * Sets the EntityManager instance.
     *
     * @param \App\Managers\Contracts\EntityManager $entities
     * @return $this
     */
    public function setEntityManager(EntityManager $entities): self
    {
        $this->entities = $entities;
        return $this;
    }

    /**
     * Sets name of the Fractal Transformer for the entity data.
     *
     * @param string $transformer
     * @return $this
     */
    public function setTransformer(string $transformer): self
    {
        if (class_exists($transformer)) {
            $this->transformer = $transformer;
        }
        return $this;
    }

    /**
     * Gets the list of all entities.
     *
     * @param array $params
     * @return \League\Fractal\Scope
     */
    public function collection(array $params): FractalScope
    {
        // Parse includes to request
        $this->fractal->parseIncludes($params['include'] ?? []);

        // Get entities paginator with data (and the includes data if they exists)
        // Set per_page param if it exists
        $paginator = $this->entities
            ->withCriteria(new EagerLoad(
                $this->fractal->getRequestedIncludes()
            ))
            ->paginate($params['per_page'] ?? 0)
            //->appends(array_except($params, ['page']));
            ->appends($params);

        // Create the new collection by the entities data transformer
        $entities = new FractalCollection($paginator->items(), $this->newTransformer());

        // Set paginator data if they exists
        if ($paginator->nextPageUrl() !== null) {
            $entities->setPaginator(new IlluminatePaginatorAdapter($paginator));
        }

        // Create entities collection data
        return $this->fractal->createData($entities);
    }

    /**
     * Gets the entity item.
     *
     * @param  int $id
     * @param array $params
     *
     * @return \League\Fractal\Scope
     */
    public function item(int $id, array $params): FractalScope
    {
        // Parse includes to request
        $this->fractal->parseIncludes($params['include'] ?? []);

        // Get entity data by its id (and the includes data if they exists)
        $entity = $this->entities
            ->withCriteria(new EagerLoad(
                $this->fractal->getRequestedIncludes()
            ))
            ->find($id);

        // Create the new item by the entity data transformer
        $entity = new FractalItem($entity, $this->newTransformer());

        // Create entity item data
        return $this->fractal->createData($entity);
    }

    /**
     * Creates the Fractal Transformer by its name.
     *
     * @return \League\Fractal\TransformerAbstract
     */
    protected function newTransformer(): TransformerAbstract
    {
        return new $this->transformer();
    }
}
