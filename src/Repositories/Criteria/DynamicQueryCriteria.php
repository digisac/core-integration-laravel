<?php

namespace DigiSac\Base\Repositories\Criteria;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;
use Williamoliveira\ArrayQueryBuilder\ArrayBuilder;

class DynamicQueryCriteria implements CriteriaInterface
{
    /**
     * @var array
     */
    protected $criteria;

    public function __construct(array $criteria)
    {
        $this->criteria = $criteria;
    }

    /**
     * Apply criteria in query repository
     *
     * @param Model $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $query = $model instanceof Model ? $model->query() : $model;

        return (new ArrayBuilder())->apply($query, $this->criteria);
    }
}
