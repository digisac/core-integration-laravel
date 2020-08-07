<?php

namespace DigiSac\Base\Repositories;

use DigiSac\Base\Models\Billet;
use Prettus\Repository\Criteria\RequestCriteria;

class BilletRepositoryEloquent extends RepositoryEloquent implements BilletRepository
{
    public function model()
    {
        return Billet::class;
    }

    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}