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
    protected $dates = ['expire_at'];

    public $incrementing = false;

    protected $guarded = [];

    protected $casts = [

    ];

    protected $appends = [

    ];

    protected $with = [

    ];


}
