<?php

namespace App\Services;

use App\Models\Company;
use App\Models\User;
use App\Services\Contracts\Context;

class CompanyContext implements Context
{
    /**
     * @var Company
     */
    protected $currentCompany;

    /**
     * @return bool
     */
    public function has()
    {
        $this->setFromCurrentUser();
        return !!$this->currentCompany;
    }

    /**
     * @return Company
     */
    public function get()
    {
        $this->setFromCurrentUser();
        return $this->currentCompany;
    }

    /**
     * @return int
     */
    public function id()
    {
        return $this->currentCompany->id;
    }

    /**
     * @param Company|null $company
     * @throws \Exception
     */
    public function set($company)
    {
        $this->currentCompany = $company;
    }

    /**
     * @throws \Exception
     */
    public function handleMissingContext()
    {
        throw new \Exception('No context defined');
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function ensureHas()
    {
        if (!$this->has()) {
            $this->handleMissingContext();
        }

        return true;
    }

    protected function setFromCurrentUser()
    {
        if ($this->currentCompany) {
            return;
        }

        /** @var User $user */
        $user = auth()->user();

        if (!$user) {
            return;
        }

        if (!$user->people) {
            $user = $user->refresh();
        }

        $this->set($user->people->companies()->first());
    }
}
