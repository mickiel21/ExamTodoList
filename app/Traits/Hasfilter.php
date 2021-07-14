<?php

namespace App\Traits;
use App\Helpers\QueryFilter;

trait HasFilter
{
    public function scopeFilter($query, QueryFilter $filters)
    {
        return $filters->apply($query);
    } 
}