<?php

namespace DigiSac\Base\Presenters;

use DigiSac\Base\Transformers\DefaultTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class InvoicePresenter
 *
 * @package namespace App\Presenters;
 */
class DefaultPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new DefaultTransformer();
    }
}
