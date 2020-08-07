<?php

namespace DigiSac\Base\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;


class Company extends BaseModel implements Transformable
{
    use TransformableTrait, SoftDeletes, Uuids;

    protected $table = 'companies';

    public $incrementing = false;

    protected $fillable = [
        'company',
        'url',
        'token',
        'settings',
    ];

    protected $casts = [
        'settings' => 'array'
    ];

    protected $appends = [

    ];

    protected $with = [
       
    ];

    public function getSetting($key = null, $default = null)
    {
        if (!$key) {
            return $this->settings;
        }

        return array_get($this->settings, $key, $default);
    }

    public function setSetting($key, $value)
    {
        $settings = $this->settings ? $this->settings : [];
        array_set($settings, $key, $value);
        $this->settings = $settings;

        return $this;
    }

}
