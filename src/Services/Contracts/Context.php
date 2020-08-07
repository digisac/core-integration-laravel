<?php

namespace App\Services\Contracts;

use App\Models\Company;

interface Context
{

    /**
     * Set the context model
     *
     * @param Company|null $context
     *
     * @return void
     */
    public function set($context);

    /**
     * Get the context model
     *
     * @return Company
     */
    public function get();

    /**
     * Check to see if the context has been set
     *
     * @return boolean
     */
    public function has();

    /**
     * Logic to handle missing context
     *
     * @return mixed
     */
    public function handleMissingContext();

    /**
     * Ensures that a context exist, by contrary abort app
     *
     * @return mixed
     */
    public function ensureHas();
}
