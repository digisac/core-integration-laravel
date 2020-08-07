<?php

namespace DigiSac\Base\Http\Controllers\Api\v1\Traits;

use DigiSac\Base\Repositories\Criteria\DynamicQueryCriteria;
use DigiSac\Base\Repositories\Repository;

trait DynamicQueryCriteriaTrait
{
    /**
     * @param Repository $repository
     * @param $requestData
     *
     * @return Repository
     */
    protected function applyDynamicQueryCriteria(Repository $repository, array $requestData)
    {
    
        if (!$requestData) {
            return $repository;
        }

        
        return $repository->pushCriteria(new DynamicQueryCriteria($requestData));
    }
}
