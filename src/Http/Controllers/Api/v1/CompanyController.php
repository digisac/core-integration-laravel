<?php

namespace DigiSac\Base\Http\Controllers\Api\v1;

use DigiSac\Base\Repositories\CompanyRepository;
use DigiSac\Base\Http\Requests\Campaign\CampaignRequest;


class CompanyController extends BaseApiController
{
    protected $repositoryClass =  CompanyRepository::class;

   // protected $formRequestClass = CampaignRequest::class;

}