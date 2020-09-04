<?php

namespace DigiSac\Base\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;


class SendRequest extends BaseModel implements Transformable
{
    use TransformableTrait, SoftDeletes;

    protected $table = 'send_request';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'endpoint',
        'method',
        'request',
        'response',
        'type',
        'status',
    ];

}
