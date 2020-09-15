<?php

namespace Rksugarfree\MessageManager\Support\Laravel;

use Illuminate\Support\Facades\Facade as BaseFacade;

class Twilio extends BaseFacade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'twilio';
    }
}