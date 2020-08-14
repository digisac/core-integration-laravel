<?php

namespace DigiSac\Base\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;


class Billet extends BaseModel implements Transformable
{
    use TransformableTrait, SoftDeletes, Uuids;

    protected $table = 'billet';

    public $incrementing = false;

    protected $fillable = [

    ];

    protected $casts = [

    ];

    protected $appends = [

    ];

    protected $with = [
       
    ];

}
