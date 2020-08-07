<?php

namespace DigiSac\Base\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use DigiSac\Base\Http\Controllers\Api\v1\Traits\DynamicQueryCriteriaTrait;
use App\Models\Account;
use App\Models\Company;
use App\Models\User;
use DigiSac\Base\Repositories\Criteria\SearchCriteria;
use DigiSac\Base\Repositories\Repository;
use DigiSac\Base\Services\Contracts\Context;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as LaravelController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, DynamicQueryCriteriaTrait;

    const PER_PAGE = 'per_page';

    /**
     * @param string $fileContent
     * @param string $filename
     * @param string $mimetype
     * @return Response
     */
    public function respondDownload($fileContent, $filename, $mimetype)
    {
        return (new Response($fileContent, 200))
            ->header('Content-Type', $mimetype)
            ->header('Content-Disposition', 'attachment; filename="'.$filename.'"');
    }

    /**
     * @param array $permissions
     */
    protected function setNeededPermissions(array $permissions)
    {
        foreach ($permissions as $permission => $methods) {
            $this->middleware('needsPermission:' . $permission, ['only' => $methods]);
        }
    }

    /**
     * @param $data
     * @return JsonResponse
     */
    protected function respondJson($data)
    {
        if (is_bool($data)) {
            $data = ['success' => !!$data];
        }

        return new JsonResponse($data);
    }

    /**
     * @return Account
     */
    public function getCurrentAccount()
    {
        return $this->getCurrentCompany()->account;
    }

    /**
     * @return Company
     */
    public function getCurrentCompany()
    {
        return app(Context::class)->get();
    }

    /**
     * @return User
     */
    protected function getCurrentUser()
    {
        return Auth::user();
    }

    /**
     * @param Repository $repository
     * @param array $searchAttributes
     * @param string|null $search
     *
     * @return Repository
     */
    protected function applySearchCriteria(Repository $repository, array $searchAttributes, $search = null)
    {
        return $repository->pushCriteria(
            new SearchCriteria($searchAttributes, $search)
        );
    }

    /**
     * @param Repository $repository
     * @return Repository
     */
    protected function applyCompanyOrAccountContextCriteria(Repository $repository)
    {
        return $repository->companyOrAccountContextScope();
    }

    /**
     * @param Repository $repository
     * @return Repository
     */
    protected function applyCompanyContextCriteria(Repository $repository)
    {
        return $repository->companyContextScope();
    }

    /**
     * @param Repository $repository
     * @return Repository
     */
    protected function applyAccountContextCriteria(Repository $repository)
    {
        return $repository->accountContextScope();
    }

    /**
     * @param Request $request
     *
     * @return int
     */
    protected function getPerPageAttribute(Request $request)
    {
        return (int) $request->get('per_page');
    }

    /**
     * @param Request $request
     *
     * @return bool
     */
    protected function getPaginateAttribute(Request $request)
    {
        return $request->get('paginate') !== 'false';
    }

    /**
     * @param Request $request
     * @param string $method
     */
    protected function doValidation(Request $request, $method = null)
    {
        if (isset($this->formRequestClass)) {
            app()->make($this->formRequestClass);
        }

        if (isset($this->storeRules) && $method === 'store') {
            $this->validate($request, $this->storeRules);
        }

        if (isset($this->updateRules) && $method === 'update') {
            $this->validate($request, $this->updateRules);
        }

        if (isset($this->rules)) {
            $this->validate($request, $this->rules);
        }
    }

    /**
     * @param array $data
     * @param array $dateKeys
     * @param string $format
     *
     * @return array
     */
    protected function convertDates(array $data, array $dateKeys, $format = 'd/m/Y')
    {
        foreach ($dateKeys as $dateKey) {
            if (!empty($data[$dateKey])) {
                $data[$dateKey] = Carbon::createFromFormat($format, $data[$dateKey]);
            }
        }

        return $data;
    }

    protected function parseFloatString($input, $decimalSep = ',', $milSep = '.')
    {
        return parseFloatString($input, $decimalSep, $milSep);
    }

    protected function parseMoneyToFloat($input, $decimalSep = ',', $milSep = '.')
    {
        return parseMoneyToFloat($input, $decimalSep, $milSep);
    }

    /**
     * @param array $data
     * @param array $keys
     * @param string $decimalSep
     * @param string $milSep
     *
     * @return array
     */
    protected function bulkParseFloatString(array $data, array $keys, $decimalSep = ',', $milSep = '.')
    {
        return bulkParseFloatString($data, $keys, $decimalSep, $milSep);
    }

    /**
     * @param array $data
     * @param array $keys
     * @param string $decimalSep
     * @param string $milSep
     *
     * @return array
     */
    protected function bulkParseMoneyToFloat(array $data, array $keys, $decimalSep = ',', $milSep = '.')
    {
        return bulkParseMoneyToFloat($data, $keys, $decimalSep, $milSep);
    }

}
