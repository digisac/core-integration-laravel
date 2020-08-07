<?php


namespace DigiSac\Base\Repositories;

use DigiSac\Base\Models\Company;
use DigiSac\Base\Presenters\DefaultPresenter;
use DigiSac\Base\Services\ContextHelpers;
use DigiSac\Base\Services\Contracts\Context;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Eloquent\BaseRepository;

abstract class RepositoryEloquent extends BaseRepository implements Repository
{

    protected $skipPresenter = true;

    /**
     * @param Model $model
     *
     * @return Model
     */
    public function save(Model $model)
    {
        /** @var Model $model */
        $model->save();
    
        return $this->parserResult($model);
    }

    /**
     * @param Company|null $company
     *
     * @return $this
     */
    public function companyContextScope($company = null)
    {
        $company = !empty($company)
            ? $company
            : app(Context::class)->get();

        $companyId = $company instanceof Model
            ? $company->id
            : $company;

        $this->model = $this->model
            ->where('company_id', $companyId);

        return $this;
    }

    /**
     * @param Company|null $company
     *
     * @return $this
     */
    public function companyOrAccountContextScope($company = null)
    {
        $company = !empty($company)
            ? $company
            : app(Context::class)->get();

        $companyId = $company instanceof Model
            ? $company->id
            : $company;

        $account = !empty($company)
            ? $company->account
            : app(Context::class)->get()->account;

        $accountId = $account instanceof Model
            ? $company->account->id
            : $account;

        $this->model = $this->model
            ->where('account_id', $accountId)
            ->orWhere('company_id', $companyId);

        return $this;
    }

    /**
     * @return $this
     */
    public function companiesContextScope()
    {
        $companies =  app(ContextHelpers::class)
            ->getCurrentPersonCompanies();

        $this->model = $this->model
            ->whereIn('company_id', $companies->pluck('id'));

        return $this;
    }

    /**
     * @return $this
     */
    public function accountContextScope()
    {
        $companies = app(ContextHelpers::class)
            ->getCurrentPersonAccountCompanies();

        $this->model = $this->model
            ->whereIn('company_id', $companies->pluck('id'));

        return $this;
    }

    public function presenter()
    {
        return DefaultPresenter::class;
    }
}
