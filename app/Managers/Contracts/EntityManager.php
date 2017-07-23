<?php
namespace App\Managers\Contracts;

/**
 * Interface EntityManager
 * @package App\Managers\Contracts
 */
interface EntityManager
{
    /**
     * Finds all entities.
     *
     * @param  array $columns
     * @return mixed Collection of entities
     */
    public function findAll(array $columns = ['*']);

    /**
     * Finds the entity by its primary key.
     *
     * @param  mixed $id
     * @param  array $columns
     *
     * @return mixed Entity
     */
    public function find($id, array $columns = ['*']);

    /**
     * Finds entities with where clause to the query.
     *
     * @param  string|array|\Closure  $column
     * @param  string  $operator
     * @param  mixed   $value
     * @param  string  $boolean
     *
     * @return mixed Collection of entities
     */
    public function findWhere(
        $column,
        string $operator = null,
        $value = null,
        string $boolean = 'and'
    );

    /**
     * Finds only the first entity with where clause to the query.
     *
     * @param  string|array|\Closure  $column
     * @param  string  $operator
     * @param  mixed   $value
     * @param  string  $boolean
     *
     * @return mixed Entity
     */
    public function findWhereFirst(
        $column,
        string $operator = null,
        $value = null,
        string $boolean = 'and'
    );

    /**
     * Finds entities with pagination.
     *
     * @param int $perPage
     * @param array $columns
     * @param bool $simple Simple or full pagination view links
     * @param string $pageName
     * @param int|null $page
     *
     * @return mixed Paginator instance
     */
    public function paginate(
        int $perPage = 15,
        array $columns = ['*'],
        bool $simple = false,
        string $pageName = 'page',
        int $page = null
    );

    /**
     * Creates a new entity.
     *
     * @param  array $properties
     * @return mixed Created Entity
     */
    public function create(array $properties);

    /**
     * Updates the entity.
     *
     * @param  mixed $id
     * @param  array $properties
     * @return bool
     */
    public function update($id, array $properties): bool;

    /**
     * Deletes the entity.
     *
     * @param  mixed $id
     * @return bool
     */
    public function delete($id): bool;
}
