<?php

namespace DigiSac\Base\Models;

use Carbon\Carbon;
use DigiSac\Base\Scopes\CompanyScope;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;


class TraceRequest extends BaseModel implements Transformable
{
    use TransformableTrait, SoftDeletes, Uuids;

    protected $table = 'trace_request';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'id_webhook',
        'type',
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
