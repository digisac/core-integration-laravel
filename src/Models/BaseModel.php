<?php

namespace DigiSac\Base\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\BaseModel
 *
 * @mixin \Eloquent
 */
class BaseModel extends Model
{
    protected $serializeDateFormat;

    public static $datagridKeys = [];

    public function setSerializeDateFormat($value)
    {
        $this->serializeDateFormat = $value;
    }

    /**
     * Prepare a date for array / JSON serialization.
     *
     * @param \DateTimeInterface $date
     *
     * @return array|string
     */
    protected function serializeDate(\DateTimeInterface $date)
    {
        switch ($this->serializeDateFormat) {
            case 'array':
                return (array)$date;
            case 'iso8601':
                return $date->format(Carbon::W3C);
            default:
                return parent::serializeDate($date);
        }
    }

}

