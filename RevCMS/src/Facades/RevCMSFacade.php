<?php

namespace RevCMS\Facades;
use Illuminate\Support\Facades\Facade;
/**
 * @see \Illuminate\View\Factory
 */
class RevCMSFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'revcms';
    }
}
