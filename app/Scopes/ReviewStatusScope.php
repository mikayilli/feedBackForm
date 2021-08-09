<?php


namespace App\Scopes;


use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class ReviewStatusScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        if(!auth()->check())
          $builder->where('status', 1);
    }
}
