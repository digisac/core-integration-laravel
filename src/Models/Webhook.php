<?php

namespace DigiSac\Base\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;


class Webhook extends BaseModel implements Transformable
{
    use TransformableTrait, SoftDeletes;

    protected $table = 'webhook';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'created_at',
        'payload'
    ];

}
