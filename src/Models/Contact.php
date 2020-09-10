<?php

namespace DigiSac\Base\Models;

use Carbon\Carbon;
use DigiSac\Base\Scopes\CompanyScope;
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
