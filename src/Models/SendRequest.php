<?php

namespace DigiSac\Base\Models;

use Carbon\Carbon;
use DigiSac\Base\Scopes\CompanyScope;
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
        'company_id'
    ];

    /*
  * CompanyScope
  * Filters company_id
  */
    protected static function boot()
    {
        static::addGlobalScope(new CompanyScope);
        parent::boot();
    }

}
