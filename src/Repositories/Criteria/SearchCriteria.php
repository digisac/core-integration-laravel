<?php

namespace DigiSac\Base\Repositories\Criteria;

use Illuminate\Database\Eloquent\Builder;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class SearchCriteria implements CriteriaInterface
{
    /**
     * @var array
     */
    protected $searchAttributes;

    /** @var string  */
    protected $search;

    public function __construct(array $searchAttributes, $search = null)
    {
        $this->searchAttributes = $searchAttributes;
        $this->search = $search ? $search : request()->get('search');
    }

    /**
     * Apply criteria in query repository
     *
     * @param Builder $model
     * @param RepositoryInterface $repository
     *
     * @return mixed|void
     */
    public function apply($model, RepositoryInterface $repository)
    {
        if (empty($this->search)) {
            return $model;
        }

        foreach ($this->searchAttributes as $searchAttribute) {
            $model->orWhere($searchAttribute, 'LIKE', "%{$this->search}%");
        }

        return $model;
    }
}
