<?php

namespace DigiSac\Base\Repositories\Criteria;

use App\Models\Person;
use Illuminate\Database\Query\Builder;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class FromPersonCriteria implements CriteriaInterface
{
    protected $person;

    public function __construct(Person $person)
    {
        $this->person = $person;
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
        return $model->where('person_id', $this->person->id);
    }
}
