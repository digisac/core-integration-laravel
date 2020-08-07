<?php

namespace DigiSac\Base\Repositories;

use DigiSac\Base\Models\Transaction;
use Prettus\Repository\Criteria\RequestCriteria;

class TransactionRepositoryEloquent extends RepositoryEloquent implements TransactionRepository
{
    public function model()
    {
        return Transaction::class;
    }

    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}