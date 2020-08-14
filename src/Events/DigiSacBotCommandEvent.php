<?php

namespace DigiSac\Base\Events;

class DigiSacBotCommandEvent
{

    public $data;
    public $contact;

    public function __construct($data, $contact)
    {
        $this->data = $data;
        $this->contact = $contact;

    }
}