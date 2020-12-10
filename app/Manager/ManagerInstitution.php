<?php

namespace App\Manager;

class ManagerInstitution
{
    /**
     * @return bool|Mixed
     */
    public function getInstitution()
    {
        if(auth()->user())
        {
            return auth()->user()->institution;
        }
        return false;
    }
}
