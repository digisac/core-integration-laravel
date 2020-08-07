<?php

namespace DigiSac\Base\Repositories;

use DigiSac\Base\Models\Contact;
use Prettus\Repository\Criteria\RequestCriteria;

class ContactRepositoryEloquent extends RepositoryEloquent implements ContactRepository
{
    public function model()
    {
        return Contact::class;
    }

    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}