<?php


namespace DigiSac\Base\Repositories\Criteria;

use Illuminate\Database\Eloquent\Builder;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class UpdatedAtGreaterCriteria implements CriteriaInterface
{
    protected $date;

    public function __construct($date)
    {
        $this->date = $date;
    }

    /**
     * Apply criteria in query repository
     *
     * @param Builder $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        if (!$this->date) {
            return $model;
        }

        return $model->where('updated_at', '>', $this->date);
    }
}
