<?php

namespace DigiSac\Base\Http\Controllers\Api\v1\Webhooks\DigiSac;

use DigiSac\Base\Http\Controllers\Controller;
use DigiSac\Base\Models\TraceRequest;
use DigiSac\Base\Models\Webhook;
use Illuminate\Http\Request;
use DigiSac\Base\Services\DigiSac\DigiSacService;

class DigiSacController extends Controller
{
    /**
     * @param Request $request
     * @return string
     */

    /*
     * GET digisac ->
     * contact_digisac_id
     * Traits/ContactTrait.php
     */


    public function botCommand(Request $request)
    {
        $data = $request->all();
        //Store request (DigiSac)
        $webhook = new Webhook();
        $webhook->id = file_get_contents('/proc/sys/kernel/random/uuid');
        $webhook->payload = json_encode($data);
        $webhook->company_id = $data['data']['accountId'];
        $webhook->save();

        //Set Webhook id
        $data['id_webhook'] = $webhook->id;

        /*
        * Trace_Request WEBHOOK
        */
        $trace_request = new TraceRequest();
        $trace_request->id = file_get_contents('/proc/sys/kernel/random/uuid');
        $trace_request->id_webhook = $webhook->id;
        $trace_request->type = 'Webhook';
        $trace_request->company_id = $data['data']['accountId'];
        $trace_request->save();

        //Continue to bot...
        if (!$data['event'] === 'bot.command') {
            return ['success' => 'success'];
        }
        $digisac = app()->make(DigiSacService::class);
        $digisac->botCommand($data);


        return ['success' => 'success'];
    }

}