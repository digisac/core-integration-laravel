<?php

namespace DigiSac\Base\Repositories\Criteria;

use Illuminate\Database\Eloquent\Builder;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class HasCompaniesCriteria implements CriteriaInterface
{

    protected $companyId;

    public function __construct($companyId)
    {
        $this->companyId = $companyId;
    }

    /**
     * Apply criteria in query repository
     *
     * @param Builder $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $model = $model->whereHas('companies', function (Builder $query) {
            if (is_array($this->companyId)) {
                return $query->whereIn('id', $this->companyId);
            }

            return $query->where('id', $this->companyId);
        });

        return $model;
    }
}
