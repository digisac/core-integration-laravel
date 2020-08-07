<?php

namespace App\Http\Controllers\Api\v1;

use App\Repositories\CompanyRepository;
use App\Http\Requests\Campaign\CampaignRequest;

class CompanyController extends BaseApiController
{
    protected $repositoryClass =  CompanyRepository::class;

   // protected $formRequestClass = CampaignRequest::class;

}