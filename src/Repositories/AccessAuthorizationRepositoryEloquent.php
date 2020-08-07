<?php

namespace DigiSac\Base\Repositories;

use DigiSac\Base\Models\AccessAuthorization;
use Prettus\Repository\Criteria\RequestCriteria;

class AccessAuthorizationRepositoryEloquent extends RepositoryEloquent implements AccessAuthorizationRepository
{
    public function model()
    {
        return AccessAuthorization::class;
    }

    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}