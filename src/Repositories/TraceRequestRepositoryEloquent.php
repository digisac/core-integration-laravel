<?php

namespace DigiSac\Base\Repositories;

use DigiSac\Base\Models\TraceRequest;
use Prettus\Repository\Criteria\RequestCriteria;

class TraceRequestRepositoryEloquent extends RepositoryEloquent implements TraceRequestRepository
{
    public function model()
    {
        return TraceRequest::class;
    }

    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));

    }
}
