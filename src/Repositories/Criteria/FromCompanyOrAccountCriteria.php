<?php

namespace DigiSac\Base\Repositories\Criteria;

use DigiSac\Base\Models\Company;
use Illuminate\Database\Query\Builder;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class FromCompanyOrAccountCriteria implements CriteriaInterface
{
    protected $company;

    public function __construct(Company $company)
    {
        $this->company = $company;
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
        return $model
            ->where(function ($query) {
                /** @var Builder $query */
                return $query->where('company_id', $this->company->id)
                    ->orWhere('account_id', $this->company->account_id);
            });
    }
}
