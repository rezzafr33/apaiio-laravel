<?php

namespace Apaiio\Laravel;

use Illuminate\Support\Facades\Facade;

class ApaiIOFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'apaiio';
    }
}
