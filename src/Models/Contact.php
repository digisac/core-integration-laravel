<?php

namespace DigiSac\Base\Models;

use Carbon\Carbon;

use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;


class Contact extends BaseModel implements Transformable
{
    use TransformableTrait, SoftDeletes, Uuids;

    protected $table = 'contacts';

    public $incrementing = false;

    protected $fillable = [
        'company_id',
        'contact_digisac_id',
        'service_digisac_id'
    ];


}
