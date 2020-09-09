<?php

namespace DigiSac\Base\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class CompanyScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $SelectedCompany = \Session::get('SelectedCompany');
        if ($SelectedCompany) {
            return $builder->where('company_id', $SelectedCompany->company_id);
        }
    }
}
