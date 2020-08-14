<?php

namespace DigiSac\Base\Events\AccessAuthorization;

class AccessAuthorizationCreateEvent
{

    public $data;
    public $contact;

    public function __construct($data,$contact)
    {
        $this->data = $data;
        $this->contact = $contact;

    }
}