<?php

namespace DigiSac\Base\Http\Middleware;

use DigiSac\Base\Models\User;
use DigiSac\Base\Repositories\CompanyRepository;
use DigiSac\Base\Services\Contracts\Context;
use Closure;

class CompanyContextSetterApi
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
    ) {

        $this->context = $context;
        $this->companyRepository = $companyRepository;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     *
     * @return mixed
     * @throws \Exception
     */
    public function handle($request, Closure $next)
    {
        $companyId = $request->get('current_company_id');

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

        return $next($request);
    }
}
