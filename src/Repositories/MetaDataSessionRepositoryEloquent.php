<?php

namespace DigiSac\Base\Repositories;

use DigiSac\Base\Models\MetaDataSession;
use Prettus\Repository\Criteria\RequestCriteria;

class MetaDataSessionRepositoryEloquent extends RepositoryEloquent implements MetaDataSessionRepository
{
    public function model()
    {
        return MetaDataSession::class;
    }

    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}