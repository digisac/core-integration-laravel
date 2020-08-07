<?php

namespace DigiSac\Base\Transformers;

use DigiSac\Base\Models\BaseModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use League\Fractal\TransformerAbstract;

/**
 * Class DefaultTransformerTransformer
 * @package namespace App\Transformers;
 */
class DefaultTransformer extends TransformerAbstract
{
    public function transform($model)
    {
        if ($model instanceof BaseModel) {
            $model->setSerializeDateFormat('array');
        }

        $relations = $model->getRelations();

        $arrayModel = $model->toArray();

        foreach ($relations as $relationName => $relation) {
            if (!($relation instanceof Model || $relation instanceof Collection)) {
                continue;
            }

            if ($relation instanceof Collection) {
                $relation->each(function ($model) {
                    if ($model instanceof BaseModel) {
                        $model->setSerializeDateFormat('array');
                    }
                });
            }

            if ($relation instanceof BaseModel) {
                $relation->setSerializeDateFormat('array');
            }

            $arrayModel[$relationName] = [
                'data' => $relation->toArray(),
            ];
        }

        return $arrayModel;
    }
}
