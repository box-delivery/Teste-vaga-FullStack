<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class StatusOnScope implements Scope
{
    /**
     * @param Builder $builder
     * @param Model $model
     * @return Builder|void
     */
    public function apply(Builder $builder, Model $model)
    {
        if(auth()->user()->roles)
        {
            foreach (auth()->user()->roles as $role)
            {
                if($role->name!="Administrator")
                {
                    return $builder->where('status', 1);
                }
            }
        }
    }
}
