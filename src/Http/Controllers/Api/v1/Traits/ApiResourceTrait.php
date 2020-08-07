<?php

namespace DigiSac\Base\Http\Controllers\Api\v1\Traits;

use DigiSac\Base\Repositories\Repository;
use Illuminate\Http\Request;

trait ApiResourceTrait
{
    use DynamicQueryCriteriaTrait, ApiControllerHelpersTrait;

    /** @var Repository */
    protected $repository;

    protected $repositoryClass = null;

    protected $transformerClass = null;

    protected $withCompanyContext = true;

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $paginate = $this->getPaginateAttribute($request);
        $perPage = $this->getPerPageAttribute($request);

        $this->applyDynamicQueryCriteria($this->getRepository(), $request->all());

        if ($this->withCompanyContext) {
            $this->applyCompanyContextCriteria($this->getRepository());
        }

        $this->getRepository()->skipPresenter(false);

        $result = ($paginate)
            ? $this->getRepository()->paginate($perPage)
            : $this->getRepository()->all();

        return $this->respond($result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->doValidation($request, 'store');

        $data = $request->all();
      
       // $data['company_id'] = $this->getCurrentCompany()->id;
        
        $this->getRepository()->skipPresenter(false);

        $result = $this->getRepository()->create($data);

        return $this->respond($result);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $this->applyDynamicQueryCriteria($this->getRepository(), $request->all());

        if ($this->withCompanyContext) {
            $this->applyCompanyContextCriteria($this->getRepository());
        }

        $this->getRepository()->skipPresenter(false);

        $result = $this->getRepository()->find($id);

        return $this->respond($result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->doValidation($request, 'update');

        $this->applyDynamicQueryCriteria($this->getRepository(), $request->all());

        if ($this->withCompanyContext) {
            $this->applyCompanyContextCriteria($this->getRepository());
        }

        $data = $request->all();

        if (isset($data['company_id'])) {
            unset($data['company_id']);
        }

        $this->getRepository()->skipPresenter(false);

        $result = $this->getRepository()->update($data, $id);

        return $this->respond($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param  int $id
     *
     * @return array
     */
    public function destroy(Request $request, $id)
    {
        $this->applyDynamicQueryCriteria($this->getRepository(), $request->all());

        if ($this->withCompanyContext) {
            $this->applyCompanyContextCriteria($this->getRepository());
        }

        $result = (bool)$this->getRepository()->delete($id);

        return $this->respond($result);
    }

    protected function getRepository()
    {
        return empty($this->repository)
            ? $this->instantiateRepository()
            : $this->repository;
    }

    protected function instantiateRepository()
    {
        
        if (!is_string($this->repositoryClass)) {
            throw new \Exception('Repository class not set.');
        }

        return $this->repository = app()->make($this->repositoryClass);
    }
}
