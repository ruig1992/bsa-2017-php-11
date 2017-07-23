<?php
namespace App\Managers;

use App\Managers\Contracts\{
    EntityManager,
    Criteria\CriteriaInterface
};
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Class AbstractEntityManager
 * @package App\Managers
 */
abstract class AbstractEntityManager implements EntityManager, CriteriaInterface
{
    /**
     * @var mixed Entity instance
     */
    protected $entity;

    public function __construct()
    {
        $this->entity = $this->makeEntity();
    }

    /**
     * Gets the Entity instance namespace for making.
     *
     * @return string Entity instance namespace
     */
    abstract public function entity(): string;

    /**
     * @inheritdoc
     */
    public function findAll(array $columns = ['*']): Collection
    {
        return $this->entity->get($columns);
    }

    /**
     * @inheritdoc
     */
    public function find($id, array $columns = ['*'])
    {
        $model = $this->entity->find($id, $columns);

        if ($model === null) {
            throw (new ModelNotFoundException)->setModel(
                get_class($this->entity->getModel()), $id
            );
        }

        return $model;
    }

    /**
     * @inheritdoc
     */
    public function findWhere(
        $column,
        string $operator = null,
        $value = null,
        string $boolean = 'and'
    ): Collection {
        return $this->entity
            ->where($column, $operator, $value, $boolean)
            ->get();
    }

    /**
     * @inheritdoc
     */
    public function findWhereFirst(
        $column,
        string $operator = null,
        $value = null,
        string $boolean = 'and'
    ) {
        $model = $this->entity
            ->where($column, $operator, $value, $boolean)
            ->first();

        if ($model === null) {
            throw (new ModelNotFoundException)->setModel(
                get_class($this->entity->getModel())
            );
        }

        return $model;
    }

    /**
     * @inheritdoc
     */
    public function paginate(
        int $perPage = 15,
        array $columns = ['*'],
        bool $simple = false,
        string $pageName = 'page',
        int $page = null
    ) {
        $method = $simple ? 'simplePaginate' : 'paginate';
        $paginator = $this->entity->$method($perPage, $columns, $pageName, $page);
        $paginator->simple = !method_exists($paginator, 'total');

        return $paginator;
    }

    /**
     * @inheritdoc
     */
    public function create(array $properties)
    {
        return $this->entity->create($properties);
    }

    /**
     * @inheritdoc
     */
    public function update($id, array $properties): bool
    {
        return $this->find($id)->update($properties);
    }

    /**
     * @inheritdoc
     */
    public function delete($id): bool
    {
        return $this->find($id)->delete();
    }

    /**
     * @inheritdoc
     */
    public function withCriteria(...$criteria): self
    {
        $criteria = array_flatten($criteria);

        foreach ($criteria as $criterion) {
            $this->entity = $criterion->apply($this->entity);
        }

        return $this;
    }

    /**
     * Makes the Entity instance by its namespace
     *
     * @return mixed Entity instance
     */
    protected function makeEntity()
    {
        return app()->make($this->entity());
    }
}
