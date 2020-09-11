<?php

namespace DigiSac\Base\Models;

use DigiSac\Base\Scopes\CompanyScope;
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
        'company_id',
        'created_at',
        'payload'
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
