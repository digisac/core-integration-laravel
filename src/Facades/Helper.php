<?php

namespace DigiSac\Base\Facades;

use Illuminate\Support\Facades\Facade;

class Helper extends Facade
{

    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'digisac.helper';
    }
}
