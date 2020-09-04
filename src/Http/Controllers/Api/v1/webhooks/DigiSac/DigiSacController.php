<?php

namespace DigiSac\Base\Http\Controllers\Api\v1\Webhooks\DigiSac;

use DigiSac\Base\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DigiSac\Base\Services\DigiSac\DigiSacService;

class DigiSacController extends Controller
{

    /**
     * @param Request $request
     * @return string
     */

    public function botCommand(Request $request)
    {      
        $data = $request->all();
        if(!$data['event'] === 'bot.command') 
        {
          return ['success' => 'success'];   
        }
        $digisac = app()->make(DigiSacService::class);
        $digisac->botCommand($data);
        return ['success' => 'success'];
    }

}