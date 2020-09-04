<?php

namespace DigiSac\Base\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;


class AccessAuthorization extends BaseModel implements Transformable
{
    use TransformableTrait, SoftDeletes, Uuids;

    protected $table = 'access_authorization';

    public $incrementing = false;

    protected $dates = [
       'expire_at'
    ];

    protected $fillable = [
        'company_id', 
        'contact_id',
        'expire_at'
    ];

    protected $casts = [

    ];

    protected $appends = [

    ];

    protected $with = [
       
    ];


}
