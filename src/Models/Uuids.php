<?php

namespace DigiSac\Base\Models;

use Webpatser\Uuid\Uuid;
use DigiSac\Base\Scopes\CompanyScope;

trait Uuids
{
    protected static function boot()
    {
        static::addGlobalScope(new CompanyScope);
        parent::boot();

        static::creating(function ($model) {
            $model->{$model->getKeyName()} = Uuid::generate()->string;
        });
    }
}
