<?php

namespace DigiSac\Base\Services\DigiSac;

use Event;
use Carbon\Carbon;
use DigiSac\Base\Events\DigiSacBotCommandEvent;
use DigiSac\Base\Repositories\ContactRepository;
use DigiSac\Base\Repositories\AccessAuthorizationRepository;
use DigiSac\Base\Events\AccessAuthorization\AccessAuthorizationCreateEvent;
use DigiSac\Base\Events\AccessAuthorization\AccessAuthorizationExpiredEvent;

class DigiSacService
{

    protected $contactRepository; 
    protected $accessAuthorizationRepository; 


    public function __construct(ContactRepository $contactRepository,AccessAuthorizationRepository $accessAuthorizationRepository)
    {
       $this->contactRepository = $contactRepository;   
       $this->accessAuthorizationRepository = $accessAuthorizationRepository;   
    }

    public function botCommand($data)
    {

        $contact = $this->contactRepository->findWhere([
          'company_id' => $data['data']['accountId'],   
          'contact_digisac_id' => $data['data']['contactId']   
        ])->first();

        if(!$contact)
        {
          $contact = $this->createContact($data);
        }

    
        if(!$this->isAccessAuthorizationExpired($contact))
        {
          return Event::dispatch(new AccessAuthorizationExpiredEvent($data,$contact)); 
        }

        return Event::dispatch(new DigiSacBotCommandEvent($data,$contact));

    }

    protected function createContact($data)
    {
       return $this->contactRepository->create([
            'company_id' => $data['data']['accountId'],
            'contact_digisac_id' => $data['data']['contactId'],
            'service_digisac_id' => $data['data']['message']['serviceId']
       ]);
    }

    protected function isAccessAuthorizationExpired($contact)
    {
      
      $now = new \DateTime();

      $access = $this->accessAuthorizationRepository->findWhere([
        'contact_id' => $contact->contact_digisac_id,
        ['expire_at','>', $now] 
      ])->first();

      if(!$access)
      {
        return false;
      }

      return true;

    }

}