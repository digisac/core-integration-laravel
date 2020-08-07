<?php

namespace DigiSac\Base\Http\Middleware;

use DigiSac\Base\Models\ModuloCompany;
use DigiSac\Base\Models\User;
use DigiSac\Base\Repositories\CompanyRepository;
use DigiSac\Base\Services\ContextHelpers;
use DigiSac\Base\Services\Contracts\Context;
use Closure;

class CompanyContextSetter
{
    protected $context;
    protected $companyRepository;

    /**
     * CompanyContextSetter constructor.
     *
     * @param Context $context
     * @param CompanyRepository $companyRepository
     */
    public function __construct(
        Context $context,
        CompanyRepository $companyRepository
    )
    {
        $this->context = $context;
        $this->companyRepository = $companyRepository;
    }


    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $companyId = $request->session()->get('company_id');

        $company = null;

        /** @var User $user */
        $user = $request->user();

        if ($user) {

            if (!$user->people) {
                throw new \Exception('Trying to login on an User with no Person');
            }

            if (!empty($companyId)) {
                $company = app(CompanyRepository::class)
                    ->accountContextScope()
                    ->find($companyId);
            }

            if (!$company) {
                $company = $user->people->companies()->first();
            }

        }

        $this->context->set($company);


        /*
         * GLOBAL PERMISSION FOR MODULE REPRESENTANTE
         */

        if ($company) {
            $Representative = ModuloCompany::join('modulos', 'modulos.id', '=', 'modulos_company.modulo_id')
                ->where('company_id', $company->id)
                ->where('modulos.code', 'representative')
                ->first();
            $help = new ContextHelpers();
            $person = $help->getCurrentPerson();
            if ($Representative && ($person && $person->representative)) {

                $rota = explode('.', \Route::getCurrentRoute()->getName());
                if (array_key_exists('0', $rota)) {
                    if (!($rota[0] == 'home' && $rota[1] == 'change-company') && $rota[0] != 'representative' && $rota[0] != 'login' && $rota[0] != 'logout') {
                        return \Redirect::route('representative.contracts')->send()->with('success', 'Você foi redirecionado ao módulo <b>Representante</b>.');
                    }
                }
            }
        }

        return $next($request);
    }
}
