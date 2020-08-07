<?php


namespace DigiSac\Base\Repositories;

use DigiSac\Base\Models\Company;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\RepositoryInterface;
use Prettus\Repository\Contracts\RepositoryCriteriaInterface;

interface Repository extends RepositoryInterface, RepositoryCriteriaInterface
{
    /**
     * @param Model $model
     *
     * @return Model
     */
    public function save(Model $model);

    /**
     * @param Company|null $company
     *
     * @return $this
     */
    public function companyContextScope($company = null);

    /**
     * @return $this
     */
    public function companiesContextScope();

    /**
     * @return $this
     */
    public function accountContextScope();

    /**
     * @param Company|null $company
     *
     * @return $this
     */
    public function companyOrAccountContextScope($company = null);

}
