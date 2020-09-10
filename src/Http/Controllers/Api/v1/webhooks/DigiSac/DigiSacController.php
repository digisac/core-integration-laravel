<?php

namespace DigiSac\Base\Http\Controllers\Api\v1\Webhooks\DigiSac;

use DigiSac\Base\Http\Controllers\Controller;
use DigiSac\Base\Models\Webhook;
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

        //accountId


        //Store request (DigiSac)
        $webhook = new Webhook();
        $webhook->id = file_get_contents('/proc/sys/kernel/random/uuid');
        $webhook->payload = json_encode($data);
        $webhook->save();




        //Continue to bot...
        if (!$data['event'] === 'bot.command') {
            return ['success' => 'success'];
        }
        $digisac = app()->make(DigiSacService::class);
        $digisac->botCommand($data);


        return ['success' => 'success'];
    }

}
