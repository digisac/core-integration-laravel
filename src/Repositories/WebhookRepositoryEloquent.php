<?php

namespace DigiSac\Base\Repositories;

use DigiSac\Base\Models\Webhook;
use Prettus\Repository\Criteria\RequestCriteria;

class WebhookRepositoryEloquent extends RepositoryEloquent implements WebhookRepository
{
    public function model()
    {
        return Webhook::class;
    }

    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
