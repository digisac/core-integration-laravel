<?php

namespace DigiSac\Base\Models;

use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;


class MetaDataSession extends BaseModel implements Transformable
{
    use TransformableTrait;

    protected $table = 'meta_data_session';

    public $incrementing = false;

    protected $fillable = [
        'type',
        'meta',
        'company_id',
        'contact_id'
    ];

    protected $casts = [
        'meta' => 'collection',
    ];

    protected $appends = [

    ];

    protected $with = [
       
    ];

}
