<?php

namespace DigiSac\Base\Repositories;

use DigiSac\Base\Models\SendRequest;
use Prettus\Repository\Criteria\RequestCriteria;

class SendRequestRepositoryEloquent extends RepositoryEloquent implements SendRequestRepository
{
    public function model()
    {
        return SendRequest::class;
    }

    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));

    }
}
