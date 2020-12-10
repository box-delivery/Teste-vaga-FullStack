<?php

namespace App\Scopes;

use App\Manager\ManagerInstitution;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class InstitutionScope implements Scope
{
    /**
     * @param Builder $builder
     * @param Model $model
     * @return Builder|void
     */
    public function apply(Builder $builder, Model $model)
    {
        $institution = app(ManagerInstitution::class)->getInstitution();
        if($institution && auth()->user()->roles->first()->name!="Administrator")
        {
            return $builder->where('institution_id', $institution->id);
        }
    }
}
