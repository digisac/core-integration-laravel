<?php

namespace DigiSac\Base\Repositories;

use DigiSac\Base\Models\Company;
use Prettus\Repository\Criteria\RequestCriteria;

class CompanyRepositoryEloquent extends RepositoryEloquent implements CompanyRepository
{
    public function model()
    {
        return Company::class;
    }

    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}