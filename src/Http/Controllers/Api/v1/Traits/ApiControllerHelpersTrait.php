<?php

namespace DigiSac\Base\Http\Controllers\Api\v1\Traits;

use App\Models\User;
use App\Transformers\DefaultTransformer;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use League\Fractal\TransformerAbstract;

trait ApiControllerHelpersTrait
{

    /**
     * @return User|Authenticatable
     */
    protected function getCurrentUser()
    {
        return $this->getAuth()->user();
    }

    /**
     * @return Guard
     */
    protected function getAuth()
    {
        return app(Guard::class);
    }

    /**
     * @param $data
     *
     * @param string|TransformerAbstract $transformer
     *
     * @return mixed
     */
    protected function respond($data, $transformer = null)
    {
        if (is_bool($data)) {
            return ['success' => $data];
        }

        // already transformed
        if (!($data instanceof Model
            || $data instanceof Collection
            || $data instanceof Paginator)) {
            return $data;
        }

        $includes = request()->get('include');

        $transformer = !empty($transformer) ? $transformer : $this->getTransformerClass();

        return fractal($data)
            ->transformWith($transformer)
            ->parseIncludes($includes)
            ->respond();
    }

    /**
     * @return string
     */
    protected function getTransformerClass()
    {
        return isset($this->transformerClass) && !empty($this->transformerClass)
            ? $this->transformerClass
            : DefaultTransformer::class;
    }

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
            ->header(
                'Content-Disposition',
                'attachment; filename="'.$filename.'"'
            );
    }

    /**
     * @param Request $request
     *
     * @param int $default
     *
     * @return int
     */
    protected function getPerPageAttribute(Request $request, $default = 15)
    {
        return (int) $request->get('per_page', $default);
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
     * @param string|null $method
     *
     * @return mixed
     */
    protected function doValidation(Request $request, $method = null)
    {        
        if (isset($this->formRequestClass) && !empty($this->formRequestClass)) {
            return app()->make($this->formRequestClass);
        }

        if (isset($this->storeRules) && $method === 'store') {
            return $this->validate($request, $this->storeRules);
        }

        if (isset($this->updateRules) && $method === 'update') {
            return $this->validate($request, $this->updateRules);
        }

        if (isset($this->rules)) {
            return $this->validate($request, $this->rules);
        }

        return null;
    }
}
