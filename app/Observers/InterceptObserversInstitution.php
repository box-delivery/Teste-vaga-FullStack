<?php

namespace App\Observers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

/**
 * Class InterceptObserversInstitution
 * @package App\Observers
 */
class InterceptObserversInstitution
{

    /**
     * @param $class
     */
    public function creating(Model $model)
    {
        if(isset(auth()->user()->institution->id))
        {
            $model->setAttribute('institution_id', auth()->user()->institution->id);
        }
    }
}
